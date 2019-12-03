<?php

use Illuminate\Database\Seeder;
use App\Flatshare;
use App\Purchase;

class PurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flatshare = Flatshare::where('name', 'Erste')->first();

        $purchace_bier = new Purchase();
        $purchace_bier->name = 'Bier';
        $purchace_bier->count = 20;
        $purchace_bier->flatshare_id = $flatshare->id;
        $purchace_bier->save();

        $purchace_klopapier = new Purchase();
        $purchace_klopapier->name = 'Klopapier';
        $purchace_klopapier->count = 1;
        $purchace_klopapier->flatshare_id = $flatshare->id;
        $purchace_klopapier->save();

    }
}
