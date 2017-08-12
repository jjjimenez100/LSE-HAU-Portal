<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 8/12/2017
 * Time: 10:15 PM
 */

$factory->define(App\Registration::class, function(Faker\Generator $faker){
   return [
        'userID' => $faker->numberBetween(1, App\User::all()->count()),
        'eventID' => $faker->numberBetween(1, App\Event::all()->count()),
   ];
});