<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin){
            $appointments = Appointment::count();
        }elseif(auth()->user()->is_user){
            $appointments = Appointment::where('user_id', auth()->user()->id)->count();
        }else {
            $appointments = Appointment::where('employee_id', auth()->user()->id)->count();
        }
        $users = User::count();
        $tests = Test::count();

        $approved = Appointment::where('status', 'approved')->count();
        $waiting = Appointment::where('status', 'waiting')->count();
        $sample_collected = Appointment::where('status', 'sample_collected')->count();
        $result_send = Appointment::where('status', 'result_send')->count();


        return view('dashboard', [
            'users' => $users,
            'tests' => $tests,
            'appointments' => $appointments,
            'approved' => $approved,
            'waiting' => $waiting,
            'sample_collected' => $sample_collected,
            'result_send' => $result_send,

        ]);

    }


}
