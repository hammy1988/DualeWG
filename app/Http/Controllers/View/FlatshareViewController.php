<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatshareViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $flatshareUsers = Auth::user()->flatshare()->first();
        return view('home', compact('flatshareUsers'));
    }

    public function flatsharemanagemeint() {
        return view('management.flatsharemain');
    }
}
