<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billingaddresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',10)->nullable();
            $table->string('order_code',50);
            $table->string('name',100);
            $table->string('phone',50);
            $table->string('email',100)->nullable();
            $table->string('address',2000);
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
        Schema::dropIfExists('billingaddresses');
    }
}
