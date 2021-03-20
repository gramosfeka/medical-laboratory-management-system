@extends('adminlte::page')

@section('title', 'All Users')

@section('content')

    <div class="row">
        <div class="col-sm-12 mb-4">
                <a href="{{ route('users.create') }}" class="btn btn-primary  font-weight-bold">Create New User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="usersTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Role</th>
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
            $('#usersTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('users.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'actions', name: 'actions'}
                ],
            });
        });
    </script>
@endpush
