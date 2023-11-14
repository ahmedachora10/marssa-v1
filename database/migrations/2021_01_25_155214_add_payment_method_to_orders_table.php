<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_payments_id')->nullable()->after('offer_id');
            $table->foreign('order_payments_id')->references('id')->on('order_payments')->cascadeOnDelete();
            $table->char('order_id')->after('id');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_order_payments_id_foreign');
            $table->dropColumn('order_payments_id');
            $table->dropColumn('order_id');
        });
    }
}
