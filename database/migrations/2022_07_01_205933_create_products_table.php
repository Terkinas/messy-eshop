<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('urltag');

            $table->string('subtitle');
            $table->string('description');

            $table->string('category');

            $table->string('color');
            $table->string('size');

            $table->integer('stock_price');
            $table->integer('price');
            $table->integer('price_onsale')->default(0);
            $table->boolean('onsale')->default(false);

            $table->integer('quantity');
            $table->integer('quantity_sold')->default(0);

            $table->string('subtag1');
            $table->string('subtag2');

            $table->boolean('active')->default(false);

            $table->unsignedInteger('added_by');

            $table->string('image_path');

            $table->foreign('added_by')->references('id')->on('users');


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
};
