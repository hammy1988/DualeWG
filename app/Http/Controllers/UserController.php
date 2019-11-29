<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
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

        if ($request->action == 'deleteFlatshare') {
            // Nur WG-Admin autorisiert, oder selbst


            $actUser = Auth::user();
            if (!(($actUser->isFlatshareAdmin() && $user->flatshare_id == $actUser->flatshare->id) ||
                $user->id == Auth::id())) {

                abort(403, 'Access denied');

            } else {

                if ($request->action == 'deleteFlatshare') {
                    $user->flatshare_id = null;
                    $user->flatsharejoin_at = null;
                }
                $user->save();

            }

        } else if ($request->action == 'acceptFlatshare' ||
                   $request->action == 'deniedFlatshare') {
            // Nur WG-Admin autorisiert

            $actUser = Auth::user();
            if (!($actUser->isFlatshareAdmin() &&
                  $user->flatshare_id == $actUser->flatshare->id)) {

                abort(403, 'Access denied');

            } else {

                if ($request->action == 'acceptFlatshare') {
                    $user->flatsharejoin_at = new \DateTime("now", new \DateTimeZone("UTC"));
                }
                if ($request->action == 'deniedFlatshare') {
                    $user->flatshare_id = null;
                    $user->flatsharejoin_at = null;
                }
                $user->save();
            }

        } else if ($request->action == 'updateFlatshare' ||
                   $request->action == 'updateProfile') {

            // Nur selbst

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

            if ($request->action == 'updateProfile') {

                $user->givenname = $request->givenname;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                return response()->json($user,200);
            }

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
