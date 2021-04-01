@extends('adminlte::page')

@section('title', 'All Appointments')

@section('content')
    @if(($base_isAdmin|| $base_isUser))
    <div class="row">
        <div class="col-sm-12 mb-4">
                <a href="{{ route('appointments.create') }}" class="btn btn-primary  font-weight-bold">Create New Appointment</a>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="appTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Patient Surname</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>






@stop


@push('js')


    <script>
        $(document).ready(function () {
            $('#appTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointments.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status',

                        "render" : function(data)
                        {
                            if (data === 'pending') {
                                return '<span class="badge badge-sm bg-danger">Pending</span>'
                            }else if(data === 'approved'){
                                return '<span class="badge badge-sm bg-primary">Approved</span>'
                            }else if(data === 'waiting'){
                                return '<span class="badge badge-sm bg-warning">Waiting</span>'
                            }else if(data === 'sample_collected'){
                                return '<span class="badge badge-sm bg-info">Sample Collected</span>'
                            }else{
                                return '<span class="badge badge-sm bg-success">Result Send</span>'
                            }

                        },
                        className: "text-center",
                        name: 'status'
                    },

                    {data: 'actions', name: 'actions'},

                ],
            });
        });
    </script>
@endpush
