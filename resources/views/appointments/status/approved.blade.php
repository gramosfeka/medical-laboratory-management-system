@extends('adminlte::page')

@section('title', 'Approved Appointments')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="approvedTable">
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
            $('#approvedTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointments.approveddatatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status',

                        "render" : function(data)
                        {
                            if (data === 'approved') {
                              return '<span class="badge badge-sm bg-primary">Approved</span>'

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
