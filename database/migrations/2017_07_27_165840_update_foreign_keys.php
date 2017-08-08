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
        Schema::table('membercredentials', function (Blueprint $table) {
            $table->foreign('roleID')->references('id')->on('roles');
        });

        Schema::table('memberinformations', function (Blueprint $table) {
            $table->foreign("credentialsID")->references('id')->on('membercredentials');
            $table->foreign("genderID")->references('id')->on('genders');
            $table->foreign("collegeID")->references('id')->on('colleges');
            $table->foreign("paymentID")->references('id')->on('payments');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('memberID')->references('id')->on('memberinformations');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->foreign('eventID')->references('id')->on('events');
            $table->foreign('memberID')->references('id')->on('memberinformations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('MemberInfos', function (Blueprint $table) {
            //
        });
    }
}
