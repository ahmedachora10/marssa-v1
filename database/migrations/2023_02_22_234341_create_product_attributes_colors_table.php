<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("attribute_value_id")->nullable();
            $table->string("name_ar", 50);
            $table->string("name_en", 50);
            $table->string("name_fr", 50);
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
        Schema::dropIfExists('product_attributes_colors');
    }
}
