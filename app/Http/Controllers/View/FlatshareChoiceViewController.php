<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlatshareChoiceViewController extends Controller
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

    public function request() {
        return view('flatsharechoice.request');
    }
}
