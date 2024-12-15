<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PropertyController extends Controller
{
    public function allProperties()
    {
        $properties = Property::latest()->get();
        return view('admin.properties.all_properties', compact('properties'));
    }

    public function addProperties()
    {
        $propertyTypes = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('admin.properties.add_properties', compact('propertyTypes', 'amenities', 'activeAgents'));
    }

    public function storeProperties(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);
        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $property_thumbnail = 'upload/property/thumbnail/' . $name_gen;

        $property_id = Property::insertGetId([
            'propertytype_id' => $request->propertytype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,

            'property_status' => $request->property_status,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,

            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,

            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail' => $property_thumbnail
        ]);

        //Multiple Image Insert
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $multi_images = 'upload/property/multi-image/' . $make_name;

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $multi_images,
            ]);
        }

        //Facilities Inert
        $facilities = Count($request->facility_name);
        if ($facilities != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }
        toastr()->success('Property is added successfully');
        return redirect()->route('all.properties');
    }

    public function editProperties($id)
    {
        $properties = Property::findOrFail($id);
        $amenity_id = $properties->amenities_id;
        $propertyAmenities = explode(",", $amenity_id);
        $propertyTypes = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        $multi_images = MultiImage::where('property_id', $id)->get();

        return view('admin.properties.edit_properties', compact('properties', 'propertyTypes', 'amenities', 'propertyAmenities', 'activeAgents', 'multi_images'));
    }
    public function updateProperties(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);

        $property_id = $request->id;
        if ($request->hasFile('property_thumbnail')) {
            if (isset($property_thumbnail) && !empty($property_thumbnail)) {
                unlink(public_path($property_thumbnail));
            }
            $image = $request->file('property_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
            $property_thumbnail = 'upload/property/thumbnail/' . $name_gen;
        }
        $existingImages = MultiImage::where('property_id', $property_id)->get();

        foreach ($existingImages as $existingImage) {
            unlink(public_path($existingImage->photo_name));
            $existingImage->delete();
        }

        if ($request->hasFile('multi_img')) {
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
                $multi_images = 'upload/property/multi-image/' . $make_name;

                MultiImage::insert([
                    'property_id' => $property_id,
                    'photo_name' => $multi_images,
                ]);
            }
        }
        Property::findOrFail($property_id)->update([
            'propertytype_id' => $request->propertytype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),

            'property_status' => $request->property_status,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,

            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,

            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'property_thumbnail' => $property_thumbnail,

        ]);
        toastr()->success('Property is updated successfully');
        return redirect()->route('all.properties');
    }
}
