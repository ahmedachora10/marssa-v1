<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount');
            $table->decimal('discount')->default(0);
            $table->integer('quantity');
            $table->string('currency')->default('USD');
            $table->integer('status')->default(0);
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('offer_id')->nullable()->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->bigInteger('promo_code_id')->nullable()->unsigned();
            $table->foreign('promo_code_id')->references('id')->on('promo_codes');
            $table->boolean('viewed')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
