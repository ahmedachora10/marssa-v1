<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('targets', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('store_id');
//            $table->foreign('store_id')->on('stores')->references('id')->onDelete('cascade');
//            $table->float('value',21,2);
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('targets');
    }
}
