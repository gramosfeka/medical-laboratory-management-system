@extends('adminlte::page')

@section('title', 'Result Send Appointments')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="result_sendTable">
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
            $('#result_sendTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointments.result_senddatatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status',

                        "render" : function(data)
                        {
                            if (data === 'result_send') {
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
