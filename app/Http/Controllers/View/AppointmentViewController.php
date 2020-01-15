<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class AppointmentViewController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkFlatshare');
        $this->middleware('checkNoFlatshareRequest');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $allUsers = User::all();
        return view('modules.appointment.appointmentmain', compact('allUsers'));
    }

}
