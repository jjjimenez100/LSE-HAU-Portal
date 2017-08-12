<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 40)->create()->each(function($user){
            $user->save();
        });

        $user = new User;
        $user->collegeID = 1;
        $user->roleID = 1;
        $user->contactNumber = "+639176677145";
        $user->email = "jimenez.johnjoshua.jjj@gmail.com";
        $user->name = "Joshua Jimenez";
        $user->password = bcrypt('secret');
        $user->rememberToken = str_random(10);

        $user = new User;
        $user->collegeID = 1;
        $user->roleID = 2;
        $user->contactNumber = "+639176622145";
        $user->email = "joemel@gmail.com";
        $user->name = "Joemel";
        $user->password = bcrypt('secret');
        $user->rememberToken = str_random(10);

        $user = new User;
        $user->collegeID = 1;
        $user->roleID = 3;
        $user->contactNumber = "+639176677145";
        $user->email = "jerez@gmail.com";
        $user->name = "Jerez";
        $user->password = bcrypt('secret');
        $user->rememberToken = str_random(10);
    }
}
