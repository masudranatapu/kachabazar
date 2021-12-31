<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('user_id',10)->nullable();
            $table->string('order_code',12);
            $table->string('product_id',150);
            $table->string('size_id',120);
            $table->string('colour_id',120);
            $table->string('quantity',50);
            $table->string('subtotal',7);
            $table->string('shipping_charge',5);
            $table->string('waraper',5);
            $table->string('total',7);
            $table->string('payment_method',100);
            $table->string('division_id',10)->nullable();
            $table->string('district_id',10)->nullable();
            $table->string('delivery_day');
            $table->string('transaction_id')->nullable();
            $table->string('status',22)->default('Pending');
            $table->string('order_status',22)->default('Pending');
            $table->string('order_type',22)->default('general');
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
