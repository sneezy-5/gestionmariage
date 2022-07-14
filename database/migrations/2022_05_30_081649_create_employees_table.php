<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id');
            $table->string('matricule')->nullable();
            $table->string('civility')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('nationality')->nullable();
            $table->string('pictureURL')->nullable();
            $table->string('CNPSnumber')->nullable();
            $table->string('CMUnumber')->nullable();
            $table->string('street')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->double('numberOfDependents')->nullable();
            $table->string('NbrOfParts')->nullable();
            $table->date('hiringDate')->nullable();
            $table->integer('seniority')->nullable();
            $table->string('currentPosition')->nullable();
            // $table->uuid('firstContractUUID')->nullable();
            // $table->uuid('currentContractUUID')->nullable();
            $table->date('exitDate')->nullable();
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
            $table->json('phonenumbers')->nullable();
            $table->json('email')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
