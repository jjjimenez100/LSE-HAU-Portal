<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 8/12/2017
 * Time: 8:49 PM
 */

$factory->define(App\Event::class, function(Faker\Generator $faker){
    return [
        'posterFileName' => $faker->word(),
        'posterPath' => $faker->word(),
        'eventName' => $faker->sentence(2, true),
        'seatCount' => $faker->randomDigit()*5,
        'eventDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});