<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('model')->nullable();
            $table->string('slug');
            $table->double('price', 8, 2);
            $table->unsignedBigInteger('size_id')->default(0);
            $table->unsignedBigInteger('color_id')->default(0);
            $table->string('image');
            $table->string('front_side_image');
            $table->string('right_side_image');
            $table->string('left_side_image');
            $table->string('back_side_image');
            $table->text('description');
            $table->double('discount_amount')->default(0);
            $table->double('discount_percentage')->default(0);
            $table->double('sale_price')->default(0);
            $table->double('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->string('affiliate_link')->nullable();
            $table->boolean('status'); 
            $table->string('meta_title',75)->nullable();
            $table->string('meta_tags')->nullable();
            $table->text('meta_description',300)->nullable();
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
        Schema::dropIfExists('products');
    }
}
