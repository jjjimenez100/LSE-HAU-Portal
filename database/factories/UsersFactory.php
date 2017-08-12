<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 8/12/2017
 * Time: 8:49 PM
 */

$factory->define(App\User::class, function(Faker\Generator $faker) {
    static $password;

   return [
       'collegeID' => $faker->numberBetween(1, App\College::all()->count()),
       'roleID' => $faker->numberBetween(1, App\Role::all()->count()),
       'contactNumber' => getUniqueContactNumber(),
       'email' => $faker->unique()->safeEmail(),
       'name' => $faker->name(),
       'password' => $password ?: $password = bcrypt('secret'),
       'remember_token' => str_random(10),
   ];
});
//'+'.$faker->unique()->randomNumber(11, true)
function getRandomNumber($min, $max){
    return rand($min, $max);
}

function getRandomContactNumber(){
    $contactNumber = "";
    for($counter = 0; $counter < 9; $counter++){
        $contactNumber .= "".getRandomNumber(1, 9)."";
    }

    return "+63".$contactNumber;
}

function getUniqueContactNumber(){
    $num = "";
    while(true){
        $num = getRandomContactNumber();
        if(App\User::where('contactNumber', $num)->count() == 0)
            break;
    }
    return $num;
}


