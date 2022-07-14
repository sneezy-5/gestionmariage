<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstContractUuidToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('firstContract_uuid')->nullable();
            $table->unsignedBigInteger('currentContract_uuid')->nullable();
            $table->foreign('firstContract_uuid')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('currentContract_uuid')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['firstContract_uuid']); 
            $table->dropColumn(['currentContract_uuid']);
        });
    }
}
