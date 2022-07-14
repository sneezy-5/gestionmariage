<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id('id')->unique();
            $table->string('contract_type')->nullable();
            $table->string('position')->nullable();
            $table->string('baseSalary')->nullable();
            $table->string('extrapay')->nullable();
            $table->string('transportationAllowance')->nullable();
            $table->date('signingDate')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->boolean('isdelete')->default(0)->nullable();
            $table->boolean('istrash')->default(0)->nullable();
            $table->boolean('isarchived')->default(0)->nullable();
            $table->json('prime')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
