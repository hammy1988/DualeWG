<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlatshareChoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkNoFlatshare');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('flatsharechoice.options');
    }

    public function join() {
        return view('flatsharechoice.join');
    }

    public function create() {
        return view('flatsharechoice.create');
    }
}
