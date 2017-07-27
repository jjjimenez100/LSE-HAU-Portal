<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MemberCredentials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roleID')->unsigned();
            $table->string('studentNumber', 9);
            $table->unique('studentNumber');
            $table->string("password", 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblMemberCredentials');
    }
}
