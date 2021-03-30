@extends('adminlte::page')

@section('title', 'Add new Appointment')

@section('content_header')
    <div class="container">
        <h1>Add new appointment</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('appointments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="name" style="display: block;"> Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="surname" style="display: block;"> Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" id="surname" value="{{ old('surname') }}" placeholder="" class="form-control @error('surname') is-invalid @enderror">
                                    @error('surname')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="date_of_birth" style="display: block;">Date of birth:</label>
                                <div class="col-sm-10">
                                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="" class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="phone_number" style="display: block;">Phone number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="" class="form-control @error('phone_number') is-invalid @enderror">
                                    @error('phone_number')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row "style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" style="display: block;" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-10">
                                <p style="color:red;"><Strong>Please choose a Date after today:</Strong></p>
                            </div>
                            </div>

                            <div class="form-group row" style="text-align: right;">

                                <label class="form-inline col-md-2 col-form-label text-right" for="date">Appointment Date:</label>
                                <div class="col-sm-10">
                                    <input type="date" name="date" id="date" value="{{Carbon\Carbon::now()}}" placeholder="" class="form-control @error('date') is-invalid @enderror">
                                    @error('date')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="time">Appointment time:</label>
                                <select name="time" id= "times" class="form-control col-sm-10 @error('times') is-invalid @enderror">
                                    @foreach($events as $event)
                                        <option value="{{ $event }}">{{ $event }}</option>
                                    @endforeach
                                 </select>
                                @error('times')
                                <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>

                            @if(($base_isAdmin))
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="user_id" style="display: block;"> User:</label>
                                <div class="col-sm-10">
                                    <select name="user_id" id= "user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        @foreach($users as $user)
                                            <option value="{{  $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <p style="color:red; position: relative; top:10px;"> <Strong>Please Select Tests in the table below:</Strong></p>
                            <div class=" table-responsive">
                            <table class="table table-bordered my-4" id="testsdTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Test Name</th>
                                        <th>Test Price</th>
                                        <th>Select Tests</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tests as $test)
                                     <tr>
                                        <th scope="row">{{$test->id}}</th>
                                        <td>{{$test->title}}</td>
                                        <td>{{$test->price}}</td>
                                        <td>
                                        <input type="checkbox" name="test[]" value="{{$test->id}}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn-btn-sm btn-primary mt-4">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')

    <script>

        $("#date").change(function () {
            var date = this.value;
            $('#times').empty();
            $.ajax({
                method: 'GET',
                url: '/appointments/getFreeEvents',
                data: {
                    method: 'GET',
                    date: date,
                },
                success: function (response) {
                    // var response = JSON.parse(response);
                    $.each(response, function(key, value){
                        $('#times').append('<option value="'+value+'">'+ value +' </option>' )
                    });
                }
            });
        });

    </script>
@endpush
