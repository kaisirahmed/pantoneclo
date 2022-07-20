<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->json('product_id');
            $table->json('product_price');
            $table->float('total_price');
            $table->float('unit');
            $table->float('quantity');
            $table->string('order_number');
            $table->string('invoice_number');
            $table->integer('order_status');
            $table->integer('payment_status');
            $table->string('payment_method');
            $table->dateTime('order_date');
            $table->dateTime('delivery_date');
            $table->bigInteger('coupon_id')->default(0);
            $table->float('discount_amount');
            $table->float('delivery_charge');
            $table->softDeletes();
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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
