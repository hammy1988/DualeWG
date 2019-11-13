<?php

namespace App\Http\Controllers;

use App\Flatshare;
use Illuminate\Http\Request;

class FlatshareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['q'] != null) {
            return response()->json(Flatshare::where('name', 'like', $request['q'] . '%')->get(), 200);
        } else {
            return response()->json(Flatshare::all(), 200);
        };
    }

    /*public function search(Request $request)
    {
        return var_dump($request->getContent());
        //return response()->json(Flatshare::where('name', 'like',), 200);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Flatshare $flatshare
     * @return \Illuminate\Http\Response
     */
    public function show(Flatshare $flatshare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Flatshare $flatshare
     * @return \Illuminate\Http\Response
     */
    public function edit(Flatshare $flatshare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Flatshare $flatshare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flatshare $flatshare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Flatshare $flatshare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flatshare $flatshare)
    {
        //
    }
}
