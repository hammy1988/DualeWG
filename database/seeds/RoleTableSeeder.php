<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_withoutwg = new Role();
        $role_withoutwg->name = 'new';
        $role_withoutwg->description = 'keiner WG zugeordnet';
        $role_withoutwg->save();

        $role_haswg = new Role();
        $role_haswg->name = 'assigned';
        $role_haswg->description = 'ist einer WG zugeordnet';
        $role_haswg->save();

        $role_wgadmin = new Role();
        $role_wgadmin->name = 'admin';
        $role_wgadmin->description = 'WG Admin';
        $role_wgadmin->save();
    }
}
