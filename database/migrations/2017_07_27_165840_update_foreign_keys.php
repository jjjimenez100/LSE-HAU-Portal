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
            $table->foreign('roleID')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign("collegeID")->references('id')->on('colleges')->onDelete('cascade');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->foreign('eventID')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
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
