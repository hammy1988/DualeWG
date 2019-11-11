<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Flatshare;

class FlatshareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_new = User::where('name', 'noob')->first();
        $user_wg = User::where('name', 'wg')->first();
        $user_admin = User::where('name', 'wgpapa')->first();

        $flatshare_erste = new Flatshare();
        $flatshare_erste->name = 'Erste';
        $flatshare_erste->tagid = 1234;
        $flatshare_erste->admin_id = $user_admin->id;
        $flatshare_erste->save();

        $user_wg->flatshare_id = Flatshare::where('name', 'Erste')->first()->id;
        $user_wg->save();
        $user_admin->flatshare_id = Flatshare::where('name', 'Erste')->first()->id;
        $user_admin->save();
    }
}
