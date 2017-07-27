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
        Schema::table('MemberCredentials', function (Blueprint $table) {
            $table->foreign('roleID')->references('id')->on('Roles');
        });

        Schema::table('MemberInfos', function (Blueprint $table) {
            $table->foreign("credentialsID")->references('id')->on('MemberCredentials');
            $table->foreign("genderID")->references('id')->on('Genders');
            $table->foreign("collegeID")->references('id')->on('Colleges');
            $table->foreign("paymentID")->references('id')->on('Payments');
        });

        Schema::table('Transactions', function (Blueprint $table) {
            $table->foreign('memberID')->references('id')->on('MemberInfos');
        });

        Schema::table('Registrations', function (Blueprint $table) {
            $table->foreign('eventID')->references('id')->on('Events');
            $table->foreign('memberID')->references('id')->on('MemberInfos');
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
