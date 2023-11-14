<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->text('description_ar');
            $table->string('title_en');
            $table->text('description_en');
            $table->string('title_fr');
            $table->text('description_fr');
            $table->text('screenshot')->nullable();
            $table->text('icon')->nullable();
            $table->text('link');

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
        Schema::dropIfExists('models');
    }
}
