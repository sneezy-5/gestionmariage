<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id('uuid');
            $table->string('serialID')->nullable();
            $table->date('issuanceDate')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->date('paymentDate')->nullable();
            $table->double('netToPay')->nullable();
            $table->double('grossIncome')->nullable();
            $table->double('TotalPayDeduction')->nullable();
            $table->double('daysWorked')->nullable();
            $table->json('hoursWorked')->nullable();
            $table->json('grossIncomeDetails')->nullable();
            $table->json('nonDeductibleIncome')->nullable();
            $table->json('companyDeductions')->nullable();
            $table->json('employeeDeductions')->nullable();
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
            $table->timestamps();
            $table->string('matricule')->nullable();
            // $table->uuid('employee_uuid');
            // $table->foreign('employee_uuid')->references('uuid')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payslips');
    }
}
