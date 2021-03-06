<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Test;
use App\Models\User;
use App\Models\Time;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
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

        Gate::authorize('create-appointments');


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
            Gate::authorize('create-appointments');
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

        Toastr::success('Appointment added successfuly', 'success');
        return redirect()->route('appointments.index');
    }

    public function edit($id){

        $appointment = Appointment::find($id);
        Gate::authorize('edit-appointments',$appointment);
        $users = User::where('role','employee')->get(['name', 'id']);

        return view('appointments.edit',compact('appointment','users'));
    }

    public function update(Request $request, $id){
        if ($request->file('file') != null) {

            $filename = time() . '.' . request()->file('file')->getClientOriginalExtension();
            request()->file->move(public_path('uploads'), $filename);
        }
        if (auth()->user()->is_admin) {
            $request->validate([
                'status' => ['required']
            ]);
        }
        $appointment = Appointment::find($id);
            $appointment->update([
                'status' => $request->status,
                'employee_id' => auth()->user()->is_admin ? $request->employee_id: auth()->user()->id ,
                'file' => auth()->user()->is_admin ? "" : ( $request->file('file')?  $filename: ""),
            ]);

        Gate::authorize('edit-appointments',$appointment);

        Toastr::success('Appointment updated successfully','Success');
        return redirect()->route('appointments.index');
    }

    public function download($file){
        return response()->download('uploads/'. $file);
    }

    public function destroy($id){

    }

    public function pendingdatatable()
    {

        if (auth()->user()->is_admin){
            $appointments = Appointment::where('status','pending')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->where('status','pending')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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

    public function pending(){
        return view('appointments.status.pending');
    }

    public function approveddatatable()
    {

        if (auth()->user()->is_admin){
            $appointments = Appointment::where('status','approved')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->where('status','approved')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->where('status','approved')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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

    public function approved(){
        return view('appointments.status.approved');
    }

    public function waitingdatatable()
    {

        if (auth()->user()->is_admin){
            $appointments = Appointment::where('status','waiting')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->where('status','waiting')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->where('status','waiting')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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

    public function waiting(){
        return view('appointments.status.waiting');
    }

    public function sample_collecteddatatable()
    {

        if (auth()->user()->is_admin){
            $appointments = Appointment::where('status','sample_collected')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->where('status','sample_collected')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->where('status','sample_collected')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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

    public function sample_collected(){
        return view('appointments.status.sample_collected');
    }

    public function result_senddatatable()
    {

        if (auth()->user()->is_admin){
            $appointments = Appointment::where('status','result_send')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->where('status','result_send')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->where('status','result_send')->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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

    public function result_send(){
        return view('appointments.status.result_send');
    }
}
