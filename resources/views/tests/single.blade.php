@extends('adminlte::page')

@section('title', 'Test Details')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

            <p class="text-center py-4">Test Name: {{ $test->title}}</p>
                <div class="card-body table-responsive">

                <table class="table table-bordered">
                <tbody>
                    <tr>
                      <th style="width:20px;">Test Description</th>
                      <td>{{$test->description}}</td>
                    </tr>
                    <tr>
                      <th>Test Interpretation</th>
                      <td>{{$test->interpretation}}</td>
                    </tr>
                    <tr>
                      <th>Price</th>
                      <td>{{$test->price}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@stop


