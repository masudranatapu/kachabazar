<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent_id',5)->nullable();
            $table->string('name',100);
            $table->string('eng',200)->nullable();
            $table->string('slug',100)->unique();
            $table->integer('order');
            $table->tinyInteger('menu')->default(0);
            $table->tinyInteger('feature')->default(0);
            $table->tinyInteger('home')->default(0);
            $table->string('image',100)->default('default.png');
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
        Schema::dropIfExists('categories');
    }
}
