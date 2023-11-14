<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('description_ar');
            $table->text('description_en');
            $table->decimal('price');
            $table->boolean('language');
            $table->boolean('ssl');
            $table->boolean('integration');
            $table->boolean('custom_domain');
            $table->boolean('custom_design');
            $table->integer('offer_count');
            $table->integer('order_count');
            $table->integer('users_count');
            $table->json('permissions')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('plans');
    }
}
