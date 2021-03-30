<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;
use App\Models\Test;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function index(){

        return view('tests.index');
    }

    public function create(){
        return view('tests.create');
    }

    public function datatable()
    {

        $tests = Test::get(['id', 'title', 'price']);

        return Datatables::of($tests)
            ->addColumn('id', function (Test $test) {
                return $test->id;
            })
            ->addColumn('title', function (Test $test) {
                return $test->title;
            })
            ->addColumn('price', function (Test $test) {
                return $test->price;
            })

            ->addColumn('actions', function (Test $test) {
                return view('tests.actions', ['test' => $test])->render();
            })
            ->rawColumns(['id', 'title', 'price','actions'])
            ->make(true);
    }

    public function show(){

        return view('tests.show');
    }

    public function testsdatatable()
    {

        $tests = Test::get(['id', 'title', 'price']);

        return Datatables::of($tests)
            ->addColumn('id', function (Test $test) {
                return $test->id;
            })
            ->addColumn('title', function (Test $test) {
                return $test->title;
            })
            ->addColumn('price', function (Test $test) {
                return $test->price;
            })
            ->addColumn('actions', function (Test $test) {
                return view('tests.inc.actionshow', ['test' => $test])->render();
            })
            ->rawColumns(['id', 'title', 'price', 'actions'])
            ->make(true);

    }



    public function store(TestRequest $request){
        Test::create([
            'title' => $request->title,
            'description' => $request->description,
            'interpretation' => $request->interpretation,
            'price' => $request->price
        ]);
        Toastr::success('Test added successfully','Success');
        return redirect()->route('tests.index');
    }

    public function single($id){
        $test = Test::find($id);
        return view('tests.single', ['test' => $test]);

    }

    public function edit($id){
        $test = Test::find($id);
        return view('tests.edit', ['test' => $test]);

    }

    public function update(TestRequest $request, $id){
        $test = Test::find($id);
        $test->update([
            'title' => $request->title,
            'description' => $request->description,
            'interpretation' => $request->interpretation,
            'price' => $request->price
        ]);
        Toastr::success('Test updated successfully','Success');
        return redirect()->route('tests.index');
    }

    public function destroy($id){
        $test = Test::find($id);
        $test->delete();
        Toastr::success('Test deleted successfully','Success');
        return redirect()->route('tests.index');
    }
}
