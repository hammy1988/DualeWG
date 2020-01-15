<?php

namespace App\Http\Controllers;

use App\Flatshare;
use App\Http\Requests\CreateFlatshareRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                return response()->json(
                    Flatshare::where('name', $wgName)
                        ->where('tagid', 'like', $tagId . '%')
                        ->orderBy('name', 'ASC')
                        ->orderBy('tagid', 'ASC')
                        ->get()
                        ->take(3), 200
                );
            } else {
                return response()->json(
                    Flatshare::where('name', 'like', $request['q'] . '%')
                        ->orderBy('name', 'ASC')
                        ->orderBy('tagid', 'ASC')
                        ->get()
                        ->take(3), 200
                );
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFlatshareRequest $request) {

        $createuser = Auth::user();


        /*$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[0-9a-zA-ZöäüÖÄÜ_\-.]+$/m', 'max:255'],
        ]);*/

        $rules = [
            'name' => ['required', 'string', 'regex:/^[0-9a-zA-ZöäüÖÄÜ_\-.]+$/m', 'max:255'],
        ];
        $customMessages = [
            'name.regex' => 'Der WG Name entspricht nicht den Voraussetzung. <br />
                             Erlaubte Eingaben sind Buchstaben, Zahlen, Punkt, Unterstrich, Bindestrich.',
            'required' => 'Bitte einen WG Namen angeben.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $flatfound = true;
        $tagid = 1000;
        while ($flatfound) {
            $tagid = rand(1000, 9999);
            $flatshare_search = Flatshare::where('name', $request->name)->where('tagid', $tagid)->get();

            if (count($flatshare_search) == 0) {
                $flatfound = false;
            } else if (count($flatshare_search) > 8999) {
                abort(406, 'Too much Flatshare entries');
            }
        }

        $flatshare = new Flatshare();
        $flatshare->name = $request->name;
        $flatshare->tagid = $tagid;
        $flatshare->admin_id = $createuser->id;
        $flatshare->save();

        $createuser->flatshare_id = $flatshare->id;
        $createuser->flatsharejoin_at = new \DateTime("now", new \DateTimeZone("UTC"));
        $createuser->crowncnt = 0;
        $createuser->save();

        return response()->json($flatshare,201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Flatshare $flatshare
     * @return \Illuminate\Http\Response
     */
    public function show(Flatshare $flatshare)
    {

        return response()->json($flatshare);

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
