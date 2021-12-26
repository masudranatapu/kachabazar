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
            $table->increments('id');
            $table->string('category_id', 5);
            $table->string('brand_id', 5)->nullable();
            $table->string('unit_id', 10)->nullable();
            $table->string('size_id', 10)->nullable();
            $table->string('colour_id', 10)->nullable();
            $table->string('title', 150);
            $table->string('eng', 200)->nullable();
            $table->string('slug', 150)->unique();
            $table->string('product_code', 12);
            $table->integer('sell_price');
            $table->integer('discount')->default(0);
            $table->integer('regular_price')->nullable();
            $table->text('long_description')->nullable();
            $table->string('availability', 13);
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('product_type', 15);
            $table->string('status', 8);
            $table->string('cover_photo', 150)->nullable();
            $table->text('others_photo')->nullable();
            $table->string('user_id', 5);
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
