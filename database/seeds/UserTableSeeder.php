<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user_new = new User();
        $user_new->name = 'noob';
        $user_new->email = 'noob@test.de';
        $user_new->password = bcrypt('pw');
        $user_new->save();

        $user_wg = new User();
        $user_wg->name = 'wg';
        $user_wg->email = 'wg@test.de';
        $user_wg->password = bcrypt('pw');
        $user_wg->save();

        $user_admin = new User();
        $user_admin->name = 'wgpapa';
        $user_admin->email = 'wgpapa@test.de';
        $user_admin->password = bcrypt('pw');
        $user_admin->save();
    }
}
