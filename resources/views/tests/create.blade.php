@extends('adminlte::page')

@section('title', 'Add new Test')

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
        <h1>Add new Test</h1>
    </div>
@stop

@section('content')
    <div class="container">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 offset-md-2">
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label " for="title" style="display: block;">Test title:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="description" style="display: block;">Description:</label>
                                <div class="col-sm-10">
                                   <textarea name="description" id="description"  class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="interpretation" style="display: block;">Interpretation:</label>
                                <div class="col-sm-10">
                                   <textarea name="interpretation" id="interpretation"  class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="price" style="display: block;">Price:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" id="price"  value="{{ old('price') }}" placeholder="" class="form-control ">
                                </div>
                            </div>
                                               
                           <button class="btn-btn-sm btn-primary mt-2">Save</button>
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
