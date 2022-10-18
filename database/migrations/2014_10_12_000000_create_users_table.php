<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('account_type');
            $table->string('password');
            $table->string('ippis_no');
            $table->string('staff_no');
            $table->string('gender');
            $table->string('department');
            $table->string('address');
            $table->string('phone');
            $table->string('nok_fname');
            $table->string('nok_lname');
            $table->string('nok_phone')->nullable();
            $table->string('nok_address');
            $table->string('nok_relationship');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
