<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function update(UpdateUserProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->only(['name', 'surname', 'email', 'phone_number', 'address']);

        $this->updateProfile($user, $data);

        Toastr::success('User updated successfully','Success');
        return redirect()->route('home');
    }


    public function updateProfile(User $user, array $data)
    {

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'phone_number'=> $data['phone_number'],
                'address'=> $data['address'],
            ])) {
                return $user;
            }

            throw new GeneralException('error');
        });
    }

    public function updatePassword(UpdateUserPasswordRequest $request){
        $user = auth()->user();

        try {
            $this->checkPassword($user, $request->only('password'));
        } catch (GeneralException $e) {
        }

        Toastr::success('User updated successfully','Success');
        return redirect()->route('home');
    }

    public function checkPassword(User $user, array $data)
    {
        if ($user->update(['password' => Hash::make($data['password'])])) {

            return $user;
        }
    }
}
