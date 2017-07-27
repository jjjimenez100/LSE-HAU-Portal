<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MemberInfos', function (Blueprint $table) {
            $table->increments('id');

            //foreign keys
            $table->integer("credentialsID")->unsigned();

            $table->integer("genderID")->unsigned();

            $table->integer("collegeID")->unsigned();

            $table->integer("paymentID")->unsigned();

            $table->string("contactNumber", 12);
            $table->string("email", 30);
            $table->string("firstName", 30);
            $table->string("lastName", 30);
            $table->string("middleName", 2);

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
        Schema::dropIfExists('MemberInfos');
    }
}
