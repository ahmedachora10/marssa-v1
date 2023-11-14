<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('plan_id')->nullable()->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->bigInteger('promo_code_id')->nullable()->unsigned();
            $table->foreign('promo_code_id')->references('id')->on('promo_code_plans');

            $table->decimal('amount_total');
            $table->decimal('discount');
            $table->string('type')->nullable();
            $table->string('country')->nullable();
            $table->string('amount_currency');
            $table->string('pay_id')->nullable();
            $table->string('token')->nullable();
            $table->integer('status')->default(1);
            $table->string('payer_id')->nullable();
            $table->text('bill')->nullable();
            
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
        Schema::dropIfExists('payments');
    }
}
