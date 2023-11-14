<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionVisitCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_visit_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_join_id");
            $table->foreign("competition_join_id")->on("competition_joins")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("competition_link_id");
            $table->foreign("competition_link_id")->on("competition_links")->references("id")->onDelete("cascade");
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
        Schema::dropIfExists('competition_visit_counts');
    }
}
