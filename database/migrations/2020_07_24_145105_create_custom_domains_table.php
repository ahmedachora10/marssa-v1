<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('custom')->unique();

            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');

            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('custom_domains');
    }
}
