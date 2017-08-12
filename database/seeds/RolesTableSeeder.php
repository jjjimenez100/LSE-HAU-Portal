<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = new Role;
        $userRole->role = "Admin";
        $userRole->save();

        $userRole = new Role;
        $userRole->role = "Officer";
        $userRole->save();

        $userRole = new Role;
        $userRole->role = "User";
        $userRole->save();
    }
}
