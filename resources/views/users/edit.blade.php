@extends('adminlte::page')

@section('title', 'Create Form User')

@section('content_header')
    <div class="container">
        <h1>Edit user</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="name" style="display: block;">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="" class="form-control @error('name') is-invalid @enderror">
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
                                    <input type="text" name="surname" id="surname" value="{{ $user->surname }}" placeholder="" class="form-control @error('surname') is-invalid @enderror">
                                    @error('surname')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="phone_number" style="display: block;">Phone number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" placeholder="" class="form-control @error('phone_number') is-invalid @enderror">
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
                                    <input type="text" name="email" id="email" value="{{ $user->email }}" placeholder="" class="form-control @error('email') is-invalid @enderror">
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
                                    <input type="text" name="address" id="address" value="{{ $user->address }}" placeholder="" class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                            <label class="form-inline col-md-2 col-form-label" for="role" style="display: block;">Role:</label>
                            <select name="role" class="form-control col-sm-10 @error('role') is-invalid @enderror">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="employee" >Employee</option>
                            </select>
                                @error('role')
                                <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>

                            <button class="btn-btn-sm btn-primary mt-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

