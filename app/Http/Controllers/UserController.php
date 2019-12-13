<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\Request;
use App\Flatshare;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
            }

            if ($request->action == 'deleteFlatshare') {
                return $this->updateDeleteFlatshare($request, $id, $user);
            }

        } else if ($request->action == 'acceptFlatshare' ||
                   $request->action == 'deniedFlatshare' ||
                   $request->action == 'removeFlatshareUser' ||
                   $request->action == 'changeFlatshareAdmin' ||
                   $request->action == 'crownClick') {
            // Nur WG-Admin autorisiert


            $actUser = Auth::user();

            if (!($actUser->isFlatshareAdmin() &&
                  $user->flatshare_id == $actUser->flatshare->id)) {
                abort(403, 'Access denied');
            }

            if ($request->action == 'acceptFlatshare') {
                $user->flatsharejoin_at = new \DateTime("now", new \DateTimeZone("UTC"));
                $user->save();
            }
            if ($request->action == 'deniedFlatshare') {
                $user->flatshare_id = null;
                $user->flatsharejoin_at = null;
                $user->save();
            }
            if ($request->action == 'removeFlatshareUser') {
                $user->flatshare_id = null;
                $user->flatsharejoin_at = null;
                $user->save();
            }
            if ($request->action == 'changeFlatshareAdmin') {
                $user->crowncnt = 0;
                $user->save();
                $flatshare = $user->flatshare()->first();
                $flatshare->admin_id = $user->id;
                $flatshare->save();
            }
            if ($request->action == 'crownClick') {
                $crownCnt = $actUser->crowncnt;
                $crownCnt += 1;
                if ($crownCnt >= 42) {
                    $actUser->crowncnt = 0;
                    $actUser->save();

                    $newRngAdm = $actUser->flatshare->newRandomAdmin($actUser);

                    if ($newRngAdm == null) {
                        return response()->json($actUser, 200);
                    } else {
                        return response()->json($newRngAdm, 200);
                    }

                } else {

                    $actUser->crowncnt = $crownCnt;
                    $actUser->save();

                }

                return response()->json($actUser,200);

            }

        } else if ($request->action == 'updateFlatshare' ||
                   $request->action == 'updateProfile' ||
                   $request->action == 'updatePassword' ||
                   $request->action == 'leaveFlatshare') {

            // Nur selbst

            if ($user->id != Auth::id()) {
                abort(403, 'Access denied');
            }

            if ($request->action == 'updateFlatshare') {
                return $this->updateFlatshare($request, $id, $user);
            }
            if ($request->action == 'updateProfile') {
                return $this->updateProfile($request, $id, $user);
            }
            if ($request->action == 'updatePassword') {
                return $this->updatePassword($request, $id, $user);
            }
            if ($request->action == 'leaveFlatshare') {
                return $this->leaveFlatshare($request, $id, $user);
            }

        }

        return $user;

    }


    private function updateDeleteFlatshare(Request $request, $id, $user)
    {

        $user->flatshare_id = null;
        $user->flatsharejoin_at = null;
        $user->save();

        return response()->json($user,200);

    }


    private function updateFlatshare(Request $request, $id, $user)
    {

        $flatshare = Flatshare::findOrFail($request->flatshareid);
        $user->flatshare_id = $flatshare->id;
        $user->save();

        if ($flatshare->admin_id == 0) {
            $flatshare->admin_id = $user->id;
            $flatshare->save();
        }

        return response()->json($user,200);

    }

    private function updateProfile(Request $request, $id, $user)
    {

        $rules = [
            'givenname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', ('unique:users,email,' . $user->id)],
        ];
        $customMessages = [
            'givenname.required' => 'Bitte geben Sie Ihren Vornamen an.',
            'givenname.max' => 'Der Vorname darf maximal 255 Zeichen lang sein.',
            'name.required' => 'Bitte geben Sie Ihren Namen an.',
            'name.max' => 'Der Name darf maximal 255 Zeichen lang sein.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $user->givenname = $request->givenname;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json($user,200);

    }

    private function updatePassword(Request $request, $id, $user)
    {

        $rules = [
            'oldpassword' => ['required', 'string'],
            'newpassword' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $customMessages = [
            'oldpassword.required' => 'Bitte geben Sie Ihr Passwort an',
            'newpassword.required' => 'Bitte geben Sie ein neues Passwort an.',
            'newpassword.min' => 'Das neue Passwort muss mindestens 8 Zeichen lang sein. <br>',
            'newpassword.confirmed' => 'Die Passwörter stimmten nicht überein.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        if (!(Hash::check($request->oldpassword, $user->password))) {
            return response()->json(['errors'=> ['oldpassword'=>'Geben Sie das korrekte Passwort ein' ]], 422);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json($user,200);

    }

    private function leaveFlatshare(Request $request, $id, $user)
    {

        if ($user->flatshare()->first()->users->count() == 1) {
            $user->flatshare()->first()->delete();
        } else if ($user->isFlatshareAdmin()) {
            $newAdmin = $user->flatshare()
                ->first()->users
                ->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)
                ->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)
                ->sortBy('flatsharejoin_at')
                ->where("id", "<>", $user->id)->first();
            $flatshare = $user->flatshare()->first();
            $flatshare->admin_id = $newAdmin->id;
            $flatshare->save();
        }

        $user->flatshare_id = null;
        $user->flatsharejoin_at = null;
        $user->save();

        return response()->json($user,200);

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
