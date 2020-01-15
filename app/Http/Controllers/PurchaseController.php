<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\User;
use App\Flatshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['q'] != null) {
            if ($request['q'] == 'list') {
                return response()->json(Purchase::where("flatshare_id", Auth::User()->flatshare->id)->where("user_id", null)->get(), 200);
            }
            if ($request['q'] == 'paid') {
                return response()->json(Purchase::where("flatshare_id", Auth::User()->flatshare->id)->where("user_id", "<>", null)->get(), 200);
            }
        }
        return response()->json(Purchase::where("flatshare_id", Auth::User()->flatshare->id)->get(), 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $createflatshare = Auth::user()->flatshare;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'count' => ['required', 'numeric'],
        ];
        $customMessages = [
            'name.required' => 'Bitte geben Sie Ihren Vornamen an.',
            'name.max' => 'Der Vorname darf maximal 255 Zeichen lang sein.',
            'count.required' => 'Bitte geben Sie Ihren Namen an.',
            'count.numeric' => 'Der Name darf maximal 255 Zeichen lang sein.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }


        $purchase = new Purchase();
        $purchase->flatshare_id = $createflatshare->id;
        $purchase->name = $request->name;
        $purchase->count = $request->count;
        $purchase->save();


        return response()->json($purchase,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
        $actUser = Auth::user();
        if (!($actUser->flatshare->id == $purchase->flatshare->id)) {
            abort(403, 'Access denied');
        }

        if ($request->action == 'paidPurchase') {
            return $this->updatePaidPurchase($request, $purchase, $actUser);
        }

    }

    private function updatePaidPurchase(Request $request, Purchase $purchase, User $actUser)
    {
        $purchase->user_id = $actUser->id;
        $purchase->paid_at = new \DateTime("now", new \DateTimeZone("UTC"));
        $purchase->save();


        return response()->json($purchase,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
        $actUser = Auth::user();
        if (!($actUser->flatshare->id == $purchase->flatshare->id)) {
            abort(403, 'Access denied');
        }

        $purchase->delete();

        return response()->json($purchase,200);

    }
}
