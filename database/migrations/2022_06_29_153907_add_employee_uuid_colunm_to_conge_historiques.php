<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeUuidColunmToCongeHistoriques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conge_historiques', function (Blueprint $table) {
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
        Schema::table('conge_historiques', function (Blueprint $table) {
            $table->dropForeign(['employee_uuid']); 
            $table->dropColumn(['employee_uuid']);
        });
    }
}