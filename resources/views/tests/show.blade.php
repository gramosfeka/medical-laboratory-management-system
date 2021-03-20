@extends('adminlte::page')

@section('title', 'All Tests')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered my-4" id="showtests">
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
            $('#showtests').DataTable({
                pagingType: 'full_numbers',
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('tests.testsdatatable') !!}',
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
