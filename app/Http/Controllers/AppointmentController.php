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

        return view('appointments.create', compact('events', 'tests'));
    }

    public function datatable()
    {
        if (auth()->user()->is_admin){
             $appointments = Appointment::get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
        }else{
            $appointments = Appointment::where('user_id', auth()->user()->id)->get(['id', 'name', 'surname', 'phone_number', 'status', 'user_id']);
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
    //   $appointments =  Appointment::create($request->all())->tests()->attach($request->input('test', []));
        Appointment::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'status' => $request->status,
            'date' =>  $request->date,
            'time' => $request->time,
            'user_id' => auth()->user()->id

        ])->tests()->attach($request->input('test', []));       
   
        
        Toastr::success('Appointment add successfuly', 'success');
        return redirect()->route('appointments.index');
    }

    public function edit($id){

        $appointment = Appointment::find($id);
        $user = User::all();
        // dd($user);
        if($appointment->status == 'none'){
            return view('appointments.edit',compact('appointment','user'));
        }elseif($appointment->status == 'approved'){
            return view('appointments.edit',compact('appointment','user'));
        }elseif($appointment->status == 'on_the_way'){
            return view('appointments.edit',compact('appointment','user'));
        }elseif($appointment->status == 'sample_collected'){
            return view('appointments.edit',compact('appointment','user'));
        }elseif($appointment->status == 'result_send'){
            return view('appointments.edit',compact('appointment','user'));
        }

        
        
    }

    public function update(AppointmentRequest $request, $id){
        $appointment = Appointment::find($id);
        $appointment->update([
         'status' => $request->status
        ]);

        Toastr::success('Appointment updated successfully','Success');
        return redirect()->route('appointments.index');
    }

    public function destroy($id){

    }
}
