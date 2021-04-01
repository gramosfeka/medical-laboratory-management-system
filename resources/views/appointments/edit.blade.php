@extends('adminlte::page')

@section('title', 'Appointment' )

@section('content_header')
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
                              <td colspan="2" class ="text-left">
                                  @if($appointment->status === 'pending')
                                      <span class="badge badge-sm bg-danger">Pending</span>
                                  @elseif($appointment->status === 'approved')
                                      <span class="badge badge-sm bg-primary">Approved</span>
                                  @elseif($appointment->status === 'waiting')
                                      <span class="badge badge-sm bg-warning">Waiting</span>
                                  @elseif($appointment->status === 'sample_collected')
                                      <span class="badge badge-sm bg-info">Sample Collected</span>
                                  @else
                                      <span class="badge badge-sm bg-success">Result Send</span>
                                @endif
                            </tr>
                            @if(($appointment->file != null))
                            <tr>
                                <th colspan="2" class= "text-right">Result</th>
                                <td colspan="2" class ="text-left"><a href="{{ route('appointments.download', ['id' => $appointment->file]) }}" class="btn btn-primary p-2">Download</a></td>
                            </tr>
                             @endif
                        </tbody>
                      </table>
                </div>

                <p style="color:red; margin-left: 25px; position: relative; top:10px;"> <Strong>Test Detail</Strong></p>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Test Name</th>
                            <th>Test Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointment->tests as $test)
                            <tr>
                                <th scope="row">{{$test->id}}</th>
                                <td>{{$test->title}}</td>
                                <td>{{$test->price}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>










                        @if((auth()->user()->is_admin && $appointment->status == 'pending' )|| (auth()->user()->is_employee && $appointment->status != 'pending'  && $appointment->status != 'result_send'))
                            <div class="col-12 text-center">

                                 <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary mt-4 " data-toggle="modal" data-target="#exampleModal">
                                Take Action
                                </button>
                            </div>
                        @endif
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
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
                                                        <option value="waiting"{{$appointment->status == 'waiting' ? 'selected' : ''}}>Waiting</option>
                                                        <option value="sample_collected" {{$appointment->status == 'sample_collected' ? 'selected' : ''}}>Sample Collected</option>
                                                        <option value="result_send" {{$appointment->status == 'result_send' ? 'selected' : ''}}>Result send</option>
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
