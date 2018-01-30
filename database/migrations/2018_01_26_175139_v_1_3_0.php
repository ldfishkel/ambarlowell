<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V130 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function(Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('payment_type');
            $table->string('sale_type');
            $table->integer('amount');
            $table->date('date');
        });

        Schema::create('debts', function(Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->unsignedInteger('sale_id');
            
            $table->integer('amount');

            $table->string('concept');
            $table->boolean('payed');
            $table->date('date');
        });

        Schema::create('balance', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->string('concept');
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
