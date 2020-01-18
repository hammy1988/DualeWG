<?php

namespace App\Http\Controllers;

use App\Flatshare;
use App\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        if ($request['q'] != null) {

            $getAppYear = substr($request['q'], 0, 4);
            $getAppMonth = substr($request['q'], 4, 2);

            $getDataFrom = Carbon::parse(($getAppYear . "-" . $getAppMonth . "-" . "01 00:00:00"), 'Europe/Berlin')->setTimezone('UTC');
            $getDataTo = Carbon::parse((Carbon::parse(($getAppYear . "-" . $getAppMonth . "-" . "01 00:00:00"))->format("Y-m-d") . " 23:59:59"), 'Europe/Berlin')->endOfMonth()->setTimezone('UTC');


            $appointments = Appointment::where("flatshare_id", Auth::User()->flatshare->id)
                ->where("start_at", ">=", $getDataFrom)
                ->where("start_at", "<=", $getDataTo)
                ->orWhere("flatshare_id", Auth::User()->flatshare->id)
                ->where("start_at", "<=", $getDataTo)
                ->where("recurring", ">", -1)
                ->get();

            return response()->json($appointments, 200);

        } else {
            $appointments = Appointment::where("flatshare_id", Auth::User()->flatshare->id)
                ->where("start_at", ">=", new \DateTime("now", new \DateTimeZone("UTC")))
                ->orWhere("flatshare_id", Auth::User()->flatshare->id)
                ->where("recurring", ">", -1)
                ->get();

            foreach ($appointments as $appointment) {

                // täglich
                if ($appointment->recurring == 0) {
                    $appointment->start_at = Carbon::parse((Carbon::now()->format("Y-m-d") . " " . Carbon::parse($appointment->start_at)->format("H:i:s")))->format("Y-m-d H:i:s");
                    if ($appointment->fullday == 0) {
                        $appointment->ent_at = Carbon::parse((Carbon::now()->format("Y-m-d") . " " . Carbon::parse($appointment->ent_at)->format("H:i:s")))->format("Y-m-d H:i:s");
                    }
                }

                if ($appointment->recurring > 0) {
                    while (Carbon::now() > Carbon::parse((Carbon::parse($appointment->start_at)->format("Y-m-d") . " 23:59:59"), 'Europe/Berlin')->setTimezone('UTC')) {
                        //wöchentlich
                        if ($appointment->recurring == 1) {
                            $appointment->start_at = Carbon::parse($appointment->start_at)->addWeek(1)->format("Y-m-d H:i:s");
                            if ($appointment->fullday == 0) {
                                $appointment->ent_at = Carbon::parse($appointment->end_at)->addWeek(1)->format("Y-m-d H:i:s");
                            }
                        }

                        //monatlich
                        if ($appointment->recurring == 2) {
                            $appointment->start_at = Carbon::parse($appointment->start_at)->addMonth(1)->format("Y-m-d H:i:s");
                            if ($appointment->fullday == 0) {
                                $appointment->ent_at = Carbon::parse($appointment->end_at)->addMonth(1)->format("Y-m-d H:i:s");
                            }
                        }

                        //jährlich
                        if ($appointment->recurring == 3) {
                            $appointment->start_at = Carbon::parse($appointment->start_at)->addYear(1)->format("Y-m-d H:i:s");
                            if ($appointment->fullday == 0) {
                                $appointment->ent_at = Carbon::parse($appointment->end_at)->addYear(1)->format("Y-m-d H:i:s");
                            }
                        }
                    }

                }

            }

            return response()->json($appointments, 200);
        }
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

        $appointment = new Appointment();
        $appointment->title = $request->title;
        $appointment->description = $request->desc;
        $appointment->start_at = Carbon::parse($request->start_at, 'Europe/Berlin')->setTimezone('UTC')->format("Y-m-d H:i:s");
        $appointment->end_at = Carbon::parse($request->end_at, 'Europe/Berlin')->setTimezone('UTC')->format("Y-m-d H:i:s");
        $appointment->fullday = $request->fullday;
        $appointment->recurring = $request->recurring;
        $appointment->flatshare_id = $createflatshare->id;
        $appointment->save();
        return response()->json($appointment ,200);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
        $actUser = Auth::user();
        if (!($actUser->flatshare->id == $appointment->flatshare->id)) {
        }

        $appointment->delete();

        return response()->json($appointment,200);
    }
}
