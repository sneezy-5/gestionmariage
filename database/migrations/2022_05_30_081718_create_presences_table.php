<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id('id');
            $table->date('periodStart')->nullable();
            $table->date('periodEnd')->nullable();
            $table->double('absentdays')->nullable();
            $table->double('presentdays')->nullable();
            $table->double('delays')->nullable();
            $table->double('normalHours')->nullable();
            $table->double('normalHoursComplementary')->nullable();
            $table->double('Overtime_15')->nullable();
            $table->double('Overtime_50')->nullable();
            $table->double('Overtime_75')->nullable();
            $table->double('Overtime_100')->nullable();
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('employee_uuid');
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
        Schema::dropIfExists('presences');
    }
}
