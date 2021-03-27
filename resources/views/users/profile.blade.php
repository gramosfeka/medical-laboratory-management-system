@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
    <div class="container">

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
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="surname" style="display: block;">Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}" placeholder="" class="form-control @error('surname') is-invalid @enderror">
                                    @error('surname')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row"style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="phone_number" style="display: block;">Phone number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="" class="form-control @error('phone_number') is-invalid @enderror">
                                    @error('phone_number')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="email" style="display: block;">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="address" style="display: block;">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" placeholder="" class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn-btn-sm btn-primary mt-2">Update</button>
                            </div>
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
                                <input type="password" name="current_password" id="current_password" value="" placeholder="" class="form-control @error('current_password') is-invalid @enderror">
                                @error('current_password')
                                <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="text-align: right;">
                            <label class="form-inline col-md-2 col-form-label text-right" for="password" style="display: block;">New Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="password" value="" placeholder="" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row"style="text-align: right;">
                            <label class="form-inline col-md-2  col-form-label" for="phone_number" style="display: block;">Password confirm :</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-10 offset-sm-2">
                         <button class="btn-btn-sm btn-primary mt-2">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

