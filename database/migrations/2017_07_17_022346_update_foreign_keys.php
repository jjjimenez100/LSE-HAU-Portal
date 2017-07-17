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
        Schema::table('tblMembers', function (Blueprint $table) {
            $table->foreign('roleID') -> references ('id') -> on('tblMemberRoles');
            $table->foreign('genderID') -> references ('id') -> on('tblGenders');
            $table->foreign('collegeID') -> references ('id') -> on('tblColleges');
            $table->foreign('paymentID') -> references ('id') -> on('tblPaymentInfo');
        });

        Schema::table('tblMemberCredentials', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('tblMembers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblMembers', function (Blueprint $table) {
            //
        });
    }
}
