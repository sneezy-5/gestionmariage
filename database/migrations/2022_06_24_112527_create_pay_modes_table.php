<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_modes', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('carte_num')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('preferential_paymentMethod')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('employee_uuid')->nullable();
            $table->foreign('employee_uuid')->references('id')->on('employees')->onDelete('cascade');
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_modes');
    }
}
