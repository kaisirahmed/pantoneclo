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
            $table->string('marchant_id');
            $table->string('code')->nullable();
            $table->string('model')->nullable();
            $table->string('slug');
            $table->string('sku');
            $table->double('price', 8, 2);
            $table->string('size', 10);
            $table->binary('image');
            $table->text('description');
            $table->double('discount_amount')->nullable();
            $table->double('discount_percentage')->nullable();
            $table->double('quantity');
            $table->unsignedBigInteger('unit_id');
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
