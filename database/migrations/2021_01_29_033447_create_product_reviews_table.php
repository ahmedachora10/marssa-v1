<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
//    public function up()
//    {
//        Schema::create('product_reviews', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->foreignId('product_id');
//            $table->string('full_name')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('email')->nullable();
//            $table->longText('content');
//            $table->integer('rate')->default(1)->comment('1-5 Star');
//            $table->integer('status')->default(0)->comment('0 : pendding | 1 : aproved');
//            $table->integer('store_id');
//            $table->timestamps();
//        });
//    }
//
//    public function down()
//    {
//        Schema::dropIfExists('product_reviews');
//    }
}
