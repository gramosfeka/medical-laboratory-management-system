@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-info">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Update Profile</h1>
    </div>
@stop

@section('content')
    <div class="container">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row"  style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="name" style="display: block;" >Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="surname" style="display: block;">Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row"style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="phone_number" style="display: block;">Phone number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="email" style="display: block;">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="address" style="display: block;">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" placeholder="" class="form-control ">
                                </div>
                            </div>


                            <button class="btn-btn-sm btn-primary mt-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <H4>Change Password</H4>
                <form action="{{ route('profile.updatePassword') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-10 offset-md-2">
                        <div class="form-group row"  style="text-align: right;">
                            <label class="form-inline col-md-2 col-form-label " for="current_password" style="display: block;" >Old Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="current_password" id="current_password" value="" placeholder="" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row" style="text-align: right;">
                            <label class="form-inline col-md-2 col-form-label text-right" for="password" style="display: block;">New Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="password" value="" placeholder="" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row"style="text-align: right;">
                            <label class="form-inline col-md-2  col-form-label" for="phone_number" style="display: block;">Password confirm :</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="" class="form-control ">
                            </div>
                        </div>


                        <button class="btn-btn-sm btn-primary mt-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop