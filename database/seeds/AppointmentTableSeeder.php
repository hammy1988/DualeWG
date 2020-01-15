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

        $appointment_vergangenheit = new Appointment();
        $appointment_vergangenheit->title = 'WG Putzen';
        $appointment_vergangenheit->description = 'Küche, Bad, Flur';
        $appointment_vergangenheit->start_at = Carbon::create('2019', '12', '20', '15', '00', '00')->format('Y-m-d H:i:s');
        $appointment_vergangenheit->fullday = true;
        $appointment_vergangenheit->recurring = -1;
        $appointment_vergangenheit->flatshare_id = $flatshare->id;
        $appointment_vergangenheit->save();

        $appointment_putzen = new Appointment();
        $appointment_putzen->title = 'WG Putzen';
        $appointment_putzen->description = 'Küche, Bad, Flur';
        $appointment_putzen->start_at = Carbon::create('2020', '06', '14', '15', '00', '00')->format('Y-m-d H:i:s');
        $appointment_putzen->fullday = true;
        $appointment_putzen->recurring = -1;
        $appointment_putzen->flatshare_id = $flatshare->id;
        $appointment_putzen->save();

        $appointment_party = new Appointment();
        $appointment_party->title = 'Dachbodenparty';
        $appointment_party->description = 'Fette Party mit Nachbarn und Studiengang :)';
        $appointment_party->start_at = Carbon::create('2020', '06', '15', '18', '00', '00')->format('Y-m-d H:i:s');
        $appointment_party->end_at = Carbon::create('2020', '06', '16', '21', '59', '00')->format('Y-m-d H:i:s');
        $appointment_party->fullday = false;
        $appointment_party->recurring = -1;
        $appointment_party->flatshare_id = $flatshare->id;
        $appointment_party->save();

        $appointment_recurring = new Appointment();
        $appointment_recurring->title = 'Bier holen';
        $appointment_recurring->description = 'wichtig :P';
        $appointment_recurring->start_at = Carbon::create('2019', '12', '11', '18', '00', '00')->format('Y-m-d H:i:s');
        $appointment_recurring->fullday = true;
        $appointment_recurring->recurring = 1;
        $appointment_recurring->flatshare_id = $flatshare->id;
        $appointment_recurring->save();
    }
}
