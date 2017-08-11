<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('roleID')->references('id')->on('roles');
            $table->foreign("collegeID")->references('id')->on('colleges');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->foreign('eventID')->references('id')->on('events');
            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //none
    }
}
