<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->boolean('status')->default(true);
            $table->decimal('discount')->nullable();
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->bigInteger('plan_id')->nullable()->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');
            
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
        Schema::dropIfExists('promo_code_plans');
    }
}
