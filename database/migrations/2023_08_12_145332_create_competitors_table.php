<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_id");
            $table->foreign("competition_id")->on("competitions")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")->on("clients")->references("id")->onDelete("cascade");
            $table->string('status')->default('active');
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('competitors');
    }
}
