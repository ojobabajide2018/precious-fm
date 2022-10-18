<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanAquiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_aquires', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('loan_types_id');
            $table->string('interest');
            $table->string('amount');
            $table->string('duration');
            $table->string('guarantor_one_name');
            $table->string('guarantor_one_phone');
            $table->string('guarantor_one_address');
            $table->string('guarantor_two_name');
            $table->string('guarantor_two_phone');
            $table->string('guarantor_two_address');
            $table->string('status');
            $table->softDeletes();
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
        Schema::dropIfExists('loan_aquires');
    }
}
