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
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('cost');
            $table->unsignedInteger('total_cost');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('size_id')->references('id')->on('food_sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
