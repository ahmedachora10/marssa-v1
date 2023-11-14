<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_id");
            $table->foreign("competition_id")->on("competitions")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign("product_id")->on("products")->references("id")->onDelete("set null");
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
        Schema::dropIfExists('competition_products');
    }
}
