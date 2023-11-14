<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');

            $table->string('link');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('content_ar')->nullable();
            $table->text('content_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

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
        Schema::dropIfExists('pages');
    }
}
