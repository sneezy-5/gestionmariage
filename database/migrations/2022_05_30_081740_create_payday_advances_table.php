<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaydayAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payday_advances', function (Blueprint $table) {
            $table->id('id');
            $table->date('RequestDate')->nullable();
            $table->double('amountRequested')->nullable();
            $table->date('paymentDate')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->date('ReimbursmentDate')->nullable();
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('employee_uuid')->nullable();
            $table->foreign('employee_uuid')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payday_advances');
    }
}
