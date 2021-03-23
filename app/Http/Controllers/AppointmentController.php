<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Test;
use App\Models\User;
use App\Models\Time;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    public function index(){
        $tests = Test::all();
        return view('appointments.index', ['tests' => $tests]);
    }

    public function getFreeEvents(Request $request){

        $times = Time::get(['time'])->toArray();

        $appointments = Appointment::where('date', $request->date)->get()->toArray();

        $busy = [];
        foreach($appointments as $appointment){
            $busy [] = $appointment['time'];
        }

        $events = [];
        foreach($times as $time){
            $events [] = $time['time'];
        }

        foreach($events as $key => $value){
            if(in_array($value, $busy)){
                unset($events[$key]);
            }
        }

        return response()->json($events);

    }

    public function create(){
        $times = Time::get(['time'])->toArray();
        $tests = Test::all();
        $users = User::where('role','user')->get(['name', 'id']);


        $appointments = Appointment::all()->toArray();

        $busy = [];
        foreach($appointments as $appointment){
            $busy [] = $appointment['time'];
        }

        $events = [];
        foreach($times as $time){
            $events [] = $time['time'];
        }

        foreach($events as $key => $value){
            if(in_array($value, $busy)){
                unset($events[$key]);
            }
        }

        return view('appointments.create', compact('events', 'tests','users'));
    }

    public function datatable()
    {
        if (auth()->user()->is_admin){
             $appointments = Appointment::get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }

        return Datatables::of($appointments)
            ->addColumn('id', function (Appointment $appointment) {
                return $appointment->id;
            })
            ->addColumn('name', function (Appointment $appointment) {
                return $appointment->name;
            })
            ->addColumn('surname', function (Appointment $appointment) {
                return $appointment->surname;
            })
            ->addColumn('phone_number', function (Appointment $appointment) {
                return $appointment->phone_number;
            })
            ->addColumn('status', function (Appointment $appointment) {
                return $appointment->status;
            })
            ->addColumn('actions', function (Appointment $appointment) {
                return view('appointments.inc.actions', ['appointment' => $appointment])->render();
            })
            ->rawColumns(['id', 'name', 'surname', 'phone_number','status','actions'])
            ->make(true);
    }



    public function store(AppointmentRequest $request){


            Appointment::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'date' =>  $request->date,
                'time' => $request->time,
                'user_id' => auth()->user()->is_admin ? $request->user_id : auth()->user()->id,

            ])->tests()->attach($request->input('test', []));




        Toastr::success('Appointment add successfuly', 'success');
        return redirect()->route('appointments.index');
    }

    public function edit($id){

        $appointment = Appointment::find($id);
        $users = User::where('role','employee')->get(['name', 'id']);

        return view('appointments.edit',compact('appointment','users'));
    }

    public function update(Request $request, $id){

        if (auth()->user()->is_admin) {
            $request->validate([
                'status' => ['required']
            ]);
        }
        $appointment = Appointment::find($id);
        if (auth()->user()->is_admin) {
            $appointment->update([
                'status' => $request->status,
                'employee_id' => $request->employee_id,

            ]);
        }else{
            $appointment->update([
                'status' => $request->status,
                $filename = time().'.'.request()->file('file')->getClientOriginalExtension(),
                request()->file->move(public_path('uploads'), $filename),
                'file' => $filename,
            ]);
        }
        Toastr::success('Appointment updated successfully','Success');
        return redirect()->route('appointments.index');
    }

    public function download($file){
        return response()->download('uploads/'. $file);
    }

    public function destroy($id){

    }
}
