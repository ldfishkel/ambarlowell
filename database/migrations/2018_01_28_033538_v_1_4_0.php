<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V140 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function(Blueprint $table) {
            $table->increments('id');            
            $table->string('info');
        });

        Schema::create('costs', function(Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        
            $table->integer('amount');
            $table->string('concept');
            $table->string('payment_type');
            $table->date('date');
        });

        Schema::create('credits', function(Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->unsignedInteger('cost_id');
            $table->foreign('cost_id')->references('id')->on('costs');
            
            $table->integer('amount');
            $table->boolean('payed');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
