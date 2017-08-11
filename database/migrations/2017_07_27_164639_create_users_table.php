<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("collegeID")->unsigned();
            $table->integer("roleID")->unsigned();
            $table->string("contactNumber", 12);
            $table->string("email");
            $table->string("name");
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
