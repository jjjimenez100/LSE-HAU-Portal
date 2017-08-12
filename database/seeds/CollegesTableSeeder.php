<?php

use Illuminate\Database\Seeder;
use App\College;
class CollegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCollege = new College;
        $userCollege->collegeDepartment = "CICT";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "SEA";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "SBA";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "CHTM";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "CCJEF";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "CNAMS";
        $userCollege->save();

        $userCollege = new College;
        $userCollege->collegeDepartment = "CASED";
        $userCollege->save();
    }
}
