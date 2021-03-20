@extends('adminlte::page')

@section('title', 'All Tests')

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-4">
                <a href="{{ route('tests.create') }}" class="btn btn-primary  font-weight-bold">Create New Test</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="testsTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Test Title</th>
                            <th>Price</th>
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
            $('#testsTable').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('tests.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'price', name: 'price'},
                    {data: 'actions', name: 'actions'}
                ],
            });
        });
    </script>
@endpush
