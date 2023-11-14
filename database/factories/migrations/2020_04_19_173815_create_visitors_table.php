<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->string('robot')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('ipAddress')->nullable();
            $table->string('ipNumber')->nullable();
            $table->string('ipVersion')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('countryName')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('timeZone')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('cityName')->nullable();
            $table->string('regionName')->nullable();
            $table->bigInteger('store_id')->nullable()->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');

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
        Schema::dropIfExists('visitors');
    }
}
