<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('amount');
            $table->string('type_operation')->default(0)->comment('0 => charge wallet , 1 => withdraw from wallet');
            $table->text('bill')->nullable();
            $table->string('type_method')->nullable();
            $table->text('token')->nullable();
            $table->text('pay_id')->nullable();
            $table->text('payer_id')->nullable();
            $table->string('status')->default(0)->comment('0 => pending , 1 => approve , 2 => disapprove');
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
        Schema::dropIfExists('merchant_wallets');
    }
}
