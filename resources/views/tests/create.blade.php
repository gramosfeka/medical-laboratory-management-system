@extends('adminlte::page')

@section('title', 'Add new Test')

@section('content_header')
    <div class="container">

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
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="description" style="display: block;">Description:</label>
                                <div class="col-sm-10">
                                   <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label text-right" for="interpretation" style="display: block;">Interpretation:</label>
                                <div class="col-sm-10">
                                   <textarea name="interpretation" id="interpretation"  class="form-control @error('interpretation') is-invalid @enderror" rows="5"></textarea>
                                    @error('interpretation')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="text-align: right;">
                                <label class="form-inline col-md-2 col-form-label" for="price" style="display: block;">Price:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" id="price"  value="{{ old('price') }}" placeholder="" class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                    <span class="invalid-feedback text-left" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
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

