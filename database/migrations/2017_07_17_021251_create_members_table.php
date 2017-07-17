<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblMembers', function (Blueprint $table) {
            $table->increments('id');

            //foreign keys
            $table->integer("roleID")->unsigned();

            $table->integer("genderID")->unsigned();

            $table->integer("collegeID")->unsigned();

            $table->integer("paymentID")->unsigned();

            //user infos
            $table->string("contactNumber", 12);
            $table->string("email", 30);
            $table->string("firstName", 30);
            $table->string("lastName", 30);
            $table->string("middleName", 2);

            //$table->foreign('genderID') -> references ('genderID') -> on('tblGenders');
            //$table->foreign('collegeID') -> references ('collegeID') -> on('tblColleges');
            //$table->foreign('paymentID') -> references ('paymentID') -> on('tblPaymentInfo');
            //$table->foreign('roleID') -> references ('roleID') -> on('tblMemberRoles');
            $table->unique('email');
            $table->unique('contactNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblMembers');
    }
}
