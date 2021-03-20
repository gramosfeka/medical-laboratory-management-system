@extends('adminlte::page')

@section('title', 'Add new Appointment')

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
                                    <form action="{{ route('appointments.update', ['appointment' => $appointment->id]) }}" method="POST" >
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">    
                                            <label class="form-inline col-md-2 col-form-label" for="status" style="display: block;">Status:</label>
                                            <select name="status" class="form-control col-sm-10">
                                                <option value="approved">Approved</option>
                                                <option value="on_the_way">On the Way</option>
                                                <option value="sample_collected" >Sample Collected</option>
                                                <option value="result_send" >Result send</option>
                                            </select>

<!--                                             
                                            <label class="form-inline col-md-3 col-form-label" for="status" style="display: block;">Employee:</label>
                                             <select name="user_id" id="user_id" class="form-control col-sm-10">
                                                @foreach($user as $key => $value)
                                                    <option value="">@if($value['role'] == 'employee') {{ $value['name'] }}@endif</option>
                                                @endforeach
                                            </select -->


                                            @if($appointment->status == "sample_collected")
                                            <label class="form-inline col-md-2 col-form-label" for="file" style="display: block;">Results:</label>
                                            <input type="file" name="file" id="file" value="{{ old('file') }}" class="">
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