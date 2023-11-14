<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamp('deadline')->nullable();
            $table->string('pay')->default('User');
            $table->boolean('status')->default(true);

            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');

            $table->bigInteger('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->bigInteger('payment_id')->nullable()->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->string('new_deadline')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribes');
    }
}
