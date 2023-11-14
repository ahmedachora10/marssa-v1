<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->json('data')->nullable();

            $table->integer('status')->comment('0: Pending | 1: Paid | 2: Canceled')->default(0);
            $table->integer('type')->comment('0: when_receiving | 1: Bankily | 2: PayPal')->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_payments');
    }
}
