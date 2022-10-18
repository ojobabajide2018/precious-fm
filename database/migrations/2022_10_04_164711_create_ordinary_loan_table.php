<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdinaryLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordinary_loan_approval', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id');
            $table->string('loan_id');
            $table->string('loan_type');
            $table->string('interest');
            $table->string('amount');
            $table->string('duration');
            $table->string('status');
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
        Schema::dropIfExists('ordinary_loan');
    }
}
