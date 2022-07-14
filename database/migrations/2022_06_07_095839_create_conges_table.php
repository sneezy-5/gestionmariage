<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->double('montant')->nullable();
            $table->integer('cumulativeDay')->nullable();
            $table->integer('tekanDay')->nullable();
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
        Schema::dropIfExists('conges');
    }
}
