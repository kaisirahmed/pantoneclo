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
            $table->unsignedBigInteger('product_id');
            $table->double('product_price');
            $table->string('unit')->nullable();
            $table->double('quantity');
            $table->double('total_price');
            $table->double('weight')->nullable();
            $table->string('color')->nullable();
            $table->double('discount_amount');
            $table->double('tax')->default(0);
            $table->double('vat')->default(0);
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
