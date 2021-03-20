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
                        <form  method="POST" action="{{route('users.update', ['user' => $user->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="name" style="display: block;">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="surname" style="display: block;">Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" id="surname" value="{{ $user->surname }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="phone_number" style="display: block;">Phone number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="email" style="display: block;">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" value="{{ $user->email }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="address" style="display: block;">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" id="address" value="{{ $user->address }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                            <label class="form-inline col-md-2 col-form-label" for="role" style="display: block;">Role:</label>
                            <select name="role" class="form-control col-sm-10">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="employee" >Employee</option>
                            </select>
                            </div>

                            <button class="btn-btn-sm btn-primary mt-2">Update</button>
                        </div>
                    </form>
                </div>
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
