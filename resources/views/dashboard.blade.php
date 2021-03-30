@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Dashboard</h3>
    <div class="row mt-5">
        @if(auth()->user()->is_admin)
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3 class="numbers" style="color:white">{{ $users }}  </h3>
                    <h4 style="color:white">All Users</h4>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    All Users &nbsp<i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3 class="numbers" style="color:white">{{$tests}}  </h3>
                    <h4 style="color:white">All Tests</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <a href="{{ route('tests.show') }}" class="small-box-footer">
                    All Tests &nbsp<i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3 class="numbers" style="color:white">{{$appointments}}  </h3>
                    <h4 style="color:white">All Appointments</h4>
                </div>
                <div class="icon">
                    <i class="far fa-calendar-check"></i>
                </div>
                <a href="{{ route('appointments.index') }}" class="small-box-footer">
                    All Appointments &nbsp<i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
            @if(!(auth()->user()->is_employee))
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="small-box bg-gradient-warning">
                        <div class="inner">
                            <h3 class="numbers" style="color:white">{{$pending}}  </h3>
                            <h4 style="color:white">Pending </h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <a href="{{ route('appointments.pending') }}" class="small-box-footer">
                            All Pending &nbsp<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 class="numbers" style="color:white">{{$approved}}  </h3>
                        <h4 style="color:white">Approved </h4>
                    </div>
                    <div class="icon">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    <a href="{{ route('appointments.approved') }}" class="small-box-footer">
                        All Approved &nbsp<i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="small-box bg-gradient-warning">
                        <div class="inner">
                            <h3 class="numbers" style="color:white">{{$waiting}}  </h3>
                            <h4 style="color:white">Waiting </h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <a href="{{ route('appointments.waiting') }}" class="small-box-footer">
                            All Waiting &nbsp<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="small-box bg-gradient-primary">
                        <div class="inner">
                            <h3 class="numbers" style="color:white">{{$sample_collected}}  </h3>
                            <h4 style="color:white">Sample Collected </h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <a href="{{ route('appointments.sample_collected') }}" class="small-box-footer">
                            All Sample Collected &nbsp<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="small-box bg-gradient-success">
                        <div class="inner">
                            <h3 class="numbers" style="color:white">
                                {{$result_send}}  </h3>
                            <h4 style="color:white">Result Send </h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <a href="{{ route('appointments.result_send') }}" class="small-box-footer">
                            All Result Send &nbsp<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

    </div>
</div>
@endsection
