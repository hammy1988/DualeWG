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
        $user_new = User::where('username', 'noob')->first();
        $user_wg = User::where('username', 'wg')->first();
        $user_admin = User::where('username', 'wgpapa')->first();

        $flatshare_erste = new Flatshare();
        $flatshare_erste->name = 'Erste';
        $flatshare_erste->tagid = 1234;
        $flatshare_erste->admin_id = $user_admin->id;
        $flatshare_erste->save();

        $user_wg->flatshare_id = Flatshare::where('name', 'Erste')->first()->id;
        $user_wg->flatsharejoin_at = new \DateTime("now", new \DateTimeZone("UTC"));
        $user_wg->save();
        $user_admin->flatshare_id = Flatshare::where('name', 'Erste')->first()->id;
        $user_admin->flatsharejoin_at = new \DateTime("now", new \DateTimeZone("UTC"));
        $user_admin->save();


        $flatshare_ersti = new Flatshare();
        $flatshare_ersti->name = 'Ersti';
        $flatshare_ersti->tagid = 2345;
        $flatshare_ersti->admin_id = 0;
        $flatshare_ersti->save();

        $flatshare_zweite = new Flatshare();
        $flatshare_zweite->name = 'Zweite';
        $flatshare_zweite->tagid = 9876;
        $flatshare_zweite->admin_id = 0;
        $flatshare_zweite->save();
    }
}
