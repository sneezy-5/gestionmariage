<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeIDRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_id_records', function (Blueprint $table) {
            $table->id('id');
            $table->string('type')->nullable();
            $table->string('idnumber')->nullable();
            $table->string('issuanceDate')->nullable();
            $table->string('expirationDate')->nullable();
            $table->string('countryOfInsuance')->nullable();
            $table->string('scanURL')->nullable();
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
        Schema::dropIfExists('employee_i_d_records');
    }
}
