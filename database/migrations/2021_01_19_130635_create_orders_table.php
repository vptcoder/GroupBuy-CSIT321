<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('groupbuy_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('status');
            $table->unsignedInteger('quantity')->default(1);
            $table->double('confirmedPrice');
            $table->string('shipping_streetaddress')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_postalcode')->nullable();
            $table->boolean('is_delivered')->default(false);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
