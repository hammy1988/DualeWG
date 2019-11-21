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
            $tagIdPos = strrpos($request['q'], "#");
            if ($tagIdPos) {
                $wgName = substr($request['q'], 0, $tagIdPos);
                $tagId = substr($request['q'], $tagIdPos + 1, strlen($request['q']));
                return response()->json(Flatshare::where('name', $wgName)->where('tagid', 'like', $tagId . '%')->get(), 200);
            } else {
                return response()->json(Flatshare::where('name', 'like', $request['q'] . '%')->get(), 200);
            }
        } else {
            return response()->json(Flatshare::all(), 200);
        };
    }

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
    public function store(Request $request) {
        return var_dump($request->getContent());
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
