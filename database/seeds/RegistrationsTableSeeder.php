<?php

use Illuminate\Database\Seeder;

class RegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Registration::class, 40)->create()->each(function($registration){
           $registration->save();
        });
    }
}
