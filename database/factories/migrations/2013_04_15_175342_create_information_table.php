<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('logo')->nullable();
            $table->text('icon')->nullable();
            $table->text('preview')->nullable();
            $table->string('title_page_ar')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('title_page_en')->nullable();
            $table->text('description_en')->nullable();
            $table->text('keyword_ar')->nullable();
            $table->text('keyword_en')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('currency')->default('MRU');
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('instagram')->nullable();
            $table->text('youtube')->nullable();
            $table->text('facebook_pixel_id')->nullable();
            $table->text('google_tag_manager')->nullable();

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
        Schema::dropIfExists('information');
    }
}
