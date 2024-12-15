<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;

class propertyTypeController extends Controller
{
    public function allType()
    {
        $propertyTypes = PropertyType::latest()->get();
        return view('admin.property_type.all_type', compact('propertyTypes'));
    }

    public function addType()
    {
        return view('admin.property_type.add_type');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required'
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        toastr()->success('New Property Type is added successfully');
        return redirect()->route('all.type');
    }

    public function editType($id)
    {
        $propertyTypes = PropertyType::findOrFail($id);
        return view('admin.property_type.edit_type', compact('propertyTypes'));
    }

    public function updateType(Request $request)
    {
        $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        toastr()->success('Property Type is updated successfully');
        return redirect()->route('all.type');
    }
    public function deleteType($id)
    {
        PropertyType::findOrFail($id)->delete();
        toastr()->success('Property Type deleted successfully', 'Congrats');
        return redirect()->back();
    }
}
