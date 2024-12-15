<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitieController extends Controller
{
    public function allAmenities()
    {
        $amenityTypes = Amenities::latest()->get();
        return view('admin.amenities.all_type', compact('amenityTypes'));
    }
    public function addAmenities()
    {
        return view('admin.amenities.add_type');
    }
    public function storeAmenities(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:amenities|max:200',
        ]);
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);
        toastr()->success('New Amenity is added successfully');
        return redirect()->route('all.amenities');
    }

    public function editAmenities($id)
    {
        $amenityTypes = Amenities::findOrFail($id);
        return view('admin.amenities.edit_type', compact('amenityTypes'));
    }

    public function updateAmenities(Request $request)
    {
        $aid = $request->id;
        Amenities::findOrFail($aid)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        toastr()->success('Amenity is updated successfully');
        return redirect()->route('all.amenities');
    }
    public function deleteAmenities($id)
    {
        Amenities::findOrFail($id)->delete();
        toastr()->success('Amenity deleted successfully', 'Congrats');
        return redirect()->back();
    }
}
