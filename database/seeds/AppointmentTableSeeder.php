<?php

use Illuminate\Database\Seeder;
use App\Flatshare;
use App\Appointment;
use Carbon\Carbon;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $flatshare = Flatshare::where('name', 'Erste')->first();

        $appointment_putzen = new Appointment();
        $appointment_putzen->title = 'WG Putzen';
        $appointment_putzen->description = 'Küche, Bad, Flur';
        $appointment_putzen->appointment_at = Carbon::create('2020', '06', '14', '15', '00', '00')->format('Y-m-d H:i:s');
        $appointment_putzen->flatshare_id = $flatshare->id;
        $appointment_putzen->save();

        $appointment_party = new Appointment();
        $appointment_party->title = 'Dachbodenparty';
        $appointment_party->description = 'Fette Party mit Nachbarn und Studiengang :)';
        $appointment_party->appointment_at = Carbon::create('2020', '06', '15', '18', '00', '00')->format('Y-m-d H:i:s');
        $appointment_party->flatshare_id = $flatshare->id;
        $appointment_party->save();
    }
}
