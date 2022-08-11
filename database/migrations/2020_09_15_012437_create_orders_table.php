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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('billing_id');
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('coupon_id')->default(0);
            $table->string('order_number')->default(0);
            $table->string('invoice_number');
            $table->unsignedBigInteger('payment_method_id')->default(0);
            $table->double('subtotal');
            $table->double('total');
            $table->double('quantity');
            $table->dateTime('date');
            $table->dateTime('shipping_date');
            $table->double('shipping_charge');
            $table->integer('status');// 1=>Pending payment, 2=>Failed, 3=>Processing, 4=>Completed, 5=>On hold, 6=>Canceled, 7=>Refunded, 8=>Authentication required
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
        Schema::dropIfExists('orders');
    }
}
