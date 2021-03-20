@extends('adminlte::page')

@section('title', 'Test Edit')

@section('content_header')
    <div class="container">
        <h1>Edit Test Details</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tests.update', ['test' => $test->id]) }}" method="POST" enctype="multipart/form-data">
                        <form  method="POST" action="{{route('tests.update', ['test' => $test->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="title" style="display: block;">Test title:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title" value="{{ $test->title }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="description" style="display: block;">Description:</label>
                                <div class="col-sm-10">
                                   <textarea name="description" id="description"  class="form-control" rows="5">{{ $test->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="interpretation" style="display: block;">Interpretation:</label>
                                <div class="col-sm-10">
                                   <textarea name="interpretation" id="interpretation"  class="form-control" rows="5">{{ $test->interpretation }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="price" style="display: block;">Price:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" id="price"  value="{{ $test->price }}" placeholder="" class="form-control ">
                                </div>
                            </div>

                            <button class="btn-btn-sm btn-primary mt-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop