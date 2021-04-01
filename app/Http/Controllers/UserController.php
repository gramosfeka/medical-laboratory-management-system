<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




class UserController extends Controller
{
    public function index(){

        return view('users.index');
    }

    public function datatable()
    {

        $users = User::get(['id', 'name', 'surname', 'phone_number', 'role', 'email', 'created_at']);

        return Datatables::of($users)
            ->addColumn('id', function (User $user) {
                return $user->id;
            })
            ->addColumn('name', function (User $user) {
                return $user->name;
            })
            ->addColumn('surname', function (User $user) {
                return $user->surname;
            })
            ->addColumn('phone_number', function (User $user) {
                return $user->phone_number;
            })
            ->addColumn('email', function (User $user) {
                return $user->email;
            })
            ->addColumn('role', function (User $user) {
                return $user->role;
            })
            ->addColumn('actions', function (User $user) {
                return view('users.actions', ['user' => $user])->render();
            })
            ->rawColumns(['id', 'name', 'surname', 'phone_number', 'email','actions','role'])
            ->make(true);
    }


    public function create(){
        return view('users.create');
    }

    public function store(UserRequest $request){
        $user = User::create([
           'name' => $request->name,
           'surname' => $request->surname,
           'phone_number' => $request->phone_number,
           'email' => $request->email,
           'address' => $request->address,
           'role' => $request->role
           ]);

           $user->update([
            'password' => Hash::make($user->name.".".$user->surname),
            ]);

        event(new UserRegistered($user));

        Toastr::success('User added successfully','Success');
        return redirect()->route('users.index', compact('user'));
    }

    public function edit($id){
       $user = User::find($id);
        return view('users.edit', ['user' => $user]);

    }

    public function update(Request $request, User $user){

        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'phone_number' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $user->id],
                'address' => ['required', 'string', 'max:255'],
                'role'=>'required',
        ]);

        if ($user->email != $request->email)
        {
            $user->update([
                'password' => Hash::make($user->name.".".$user->surname),
                'email' => $request->email,
            ]);
            event(new UserRegistered($user));
        }

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => $request->role
            ]);
        Toastr::success('User updated successfully','Success');
        return redirect()->route('users.index');

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        Toastr::success('User deleted successfully','Success');
        return redirect()->route('users.index');
    }
}
