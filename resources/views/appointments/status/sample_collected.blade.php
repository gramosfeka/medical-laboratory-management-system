@extends('adminlte::page')

@section('title', 'Sample Collected Appointments')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="sample_collectedTable">
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
            $('#sample_collectedTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointments.sample_collecteddatatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status',

                        "render" : function(data)
                        {
                            if (data === 'sample_collected') {
                                return '<span class="badge badge-sm bg-info">Sample Collected</span>'
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
