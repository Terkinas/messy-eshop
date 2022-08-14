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
        Schema::create('omniva', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('set null');

            $table->string('name');
            $table->string('xcordinate');
            $table->string('ycordinate');
            $table->bigInteger('terminalId');
            $table->string('city');
            $table->string('street');
            $table->string('comment');


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
        Schema::dropIfExists('omniva');
    }
};
