<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.user_profile', compact('userData'));
    }

    public function userProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();
        return redirect()->back();
    }

    public function userLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.change_password', compact('userData'));
    }
    public function userUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
        if (!Hash::check($request->current_password, auth::user()->password)) {
            toastr()->error('Incorrect old password');
            return redirect()->back();
        }
        if (User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ])) {
            return redirect()->back();
            toastr()->success('Password updated successfully');
        }
        if ($request->new_password !== $request->confirm_password) {
            toastr()->error('Incorrect old password');
            return redirect()->back();
        }
    }
}
