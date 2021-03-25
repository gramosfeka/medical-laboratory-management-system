@extends('adminlte::page')

@section('title', 'Appointment' )

@section('content_header')
    <div class="container">

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

            <p class="text-center py-4"><strong>Appointment for {{ $appointment->name." ". $appointment->surname}} </strong></p>
                <div class="card-body table-responsive">
                <table class="table table-bordered">
                <tbody>

                    <tr>
                      <th style="table-layout: fixed; width: 180px;">ID</th>
                      <td style="table-layout: fixed; width: 180px;">{{$appointment->id}}</td>
                      <th style="table-layout: fixed; width: 180px;">Email</th>
                      <td style="table-layout: fixed; width: 180px;">{{$appointment->email}}</td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td>{{$appointment->name}} </td>
                      <th>Phone Number</th>
                      <td>{{$appointment->phone_number}}</td>
                    </tr>
                    <tr>
                      <th>Surname</th>
                      <td>{{$appointment->surname}} </td>
                      <th>Appointment Date</th>
                      <td>{{$appointment->date}}</td>
                    </tr>
                    <tr>
                      <th>Date of birth</th>
                      <td>{{$appointment->date_of_birth}} </td>
                      <th>Appointment Time</th>
                      <td>{{$appointment->time}}</td>
                    </tr>
                    <tr>
                      <th colspan="2" class= "text-right">Status</th>
                      <td colspan="2" class ="text-left">{{$appointment->status}}</td>
                    </tr>
                    @if(($appointment->file != null))
                        <tr>
                            <th colspan="2" class= "text-right">Result</th>
                            <td colspan="2" class ="text-left"><a href="{{ route('appointments.download', ['id' => $appointment->file]) }}" class="btn btn-primary p-2">Download</a></td>
                        </tr>
                     @endif
                    </tbody>
                  </table>

                <div class="col-12 text-center">

                         <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mt-4 " data-toggle="modal" data-target="#exampleModal">
                        Take Action
                        </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('appointments.update', ['appointment' => $appointment->id]) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            @if(($base_isAdmin  && $appointment->status == 'pending'))
                                                <label class="form-inline col-md-2 col-form-label" for="status" style="display: block;">Status:</label>
                                                <select name="status" class="form-control col-sm-10 @error('status') is-invalid @enderror">
                                                    <option value="approved">Approved</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                                <label class="form-inline col-md-3 col-form-label" for="employee_id" style="display: block;">Assign to:</label>
                                                <select name="employee_id" id="employee_id" class="form-control col-sm-10 @error('employee_id') is-invalid @enderror">
                                                    @foreach($users as $employee)
                                                        <option value="{{$employee->id}}">{{ $employee->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee_id')
                                                     <span class="invalid-feedback text-left" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            @endif

                                            @if(($base_isEmployee))
                                                <label class="form-inline col-md-2 col-form-label" for="status" style="display: block;">Status:</label>
                                                <select name="status" class="form-control col-sm-10 @error('status') is-invalid @enderror">
                                                    <option value="waiting">Waiting</option>
                                                    <option value="sample_collected" >Sample Collected</option>
                                                    <option value="result_send" >Result send</option>
                                                </select>
                                                    @error('status')
                                                         <span class="invalid-feedback text-left" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                            @endif


                                            @if($base_isEmployee && $appointment->status == "sample_collected")
                                                <label class="form-inline col-md-2 col-form-label" for="file" style="display: block;">Results:</label>
                                                <input type="file" name="file" id="file" value="{{ old('file') }}" class="@error('file') is-invalid @enderror">
                                                @error('file')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        {{ $message }}
                                                     </span>
                                                @enderror
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
