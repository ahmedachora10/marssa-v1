<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_affiliates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invitee_id')->unsigned();
            $table->foreign('invitee_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('affiliate_id')->unsigned();
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
            $table->string('type');
            $table->decimal('value', 10, 2)->default(0);
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
        Schema::dropIfExists('profit_affiliates');
    }
}
