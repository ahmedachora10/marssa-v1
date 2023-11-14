<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();            
            $table->string("name_ar", 255);
            $table->string("name_en", 255);
            $table->string("name_fr", 255);
            $table->string("display_type_ar", 70)->nullable();
            $table->string("display_type_en", 70)->nullable();
            $table->string("display_type_fr", 70)->nullable();
            $table->text("description_ar")->nullable();
            $table->text("description_en")->nullable();
            $table->text("description_fr")->nullable();
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->foreign("updated_by")->on("users")->references("id")->onDelete("cascade");
            $table->timestamps();
        });

       // DB::statement("INSERT INTO `attributes` (`id`, `name`, `display_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
    //    (1, 'Color', 'radio_button', 'this is for color atrribute.', 1, '2023-02-23 01:35:26', '2023-02-23 01:35:26')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
