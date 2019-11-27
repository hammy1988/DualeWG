<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flatshare;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        if ($user->id != Auth::id()) {
            abort(403, 'Access denied');
        }

        if ($request->action == 'updateFlatshare') {

            $flatshare = Flatshare::findOrFail($request->flatshareid);
            $user->flatshare_id = $flatshare->id;
            $user->save();

            if ($flatshare->admin_id == 0) {
                $flatshare->admin_id = $user->id;
                $flatshare->save();
            }

            return response()->json($user,200);
        }


        return $user;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
