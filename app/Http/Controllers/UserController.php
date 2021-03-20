<?php

namespace App\Http\Controllers;

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
            'password' => str::random(10),
            ]);
        Toastr::success('User added successfully','Success');
        return redirect()->route('users.index', compact('user'));
    }

    public function edit($id){
       $user = User::find($id);
        return view('users.edit', ['user' => $user]);

    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role
            ]);
        Toastr::success('User updated successfully','Success');
        return redirect()->route('users.index');

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        Toastr::error('User deleted successfully','Success');
        return redirect()->route('users.index');
    }
}
