<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        Toastr::success('User updated successfully','Success');
        return redirect()->route('home');
    }

    public function updatePassword(Request $request){
        $user = auth()->user();
    }
}
