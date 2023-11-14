<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('domain');
            $table->text('new_domain')->nullable();
            $table->tinyinteger('status')->default(0);
            $table->integer('language')->default(0);
            $table->integer('design')->nullable();
            $table->bigInteger('plan_id')->nullable()->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->bigInteger('information_id')->nullable()->unsigned();
            $table->foreign('information_id')->references('id')->on('information');
            $table->timestamps();
            $table->softDeletes();
            # $table->json('payment_methods')->nullable()->after('plan_id')->default('{"paypal":{"paypal_status":"0","paypal_client_id":"","paypal_secret":"","paypal_type":"sandbox","Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}},"Bankily":{"Bankily_status":"0","Bankily_name_transfer_method":null,"Bankily_account_number":null,"Bankily_account_name":null,"Bankily_account_iban":null,"Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}},"Paiement_when_receiving":{"Paiement_when_receiving_status":"0","Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}},"Bank_transfer":{"Bank_transfer_status":"0","Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}}}');
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
        Schema::dropIfExists('stores');
    }
}
