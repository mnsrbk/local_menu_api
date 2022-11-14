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
            $table->string('code');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->unsignedInteger('cost');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('service_cost')->default(0);
            $table->unsignedInteger('total_cost');
            $table->boolean('is_paid')->default(false);
            $table->boolean('bill_taken')->default(false);
            $table->boolean('takeaway')->default(false);
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('waiter_id')->references('id')->on('users');
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