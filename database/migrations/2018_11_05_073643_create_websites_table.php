<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_tag')->nullable();
            $table->string('email');
            $table->text('address');
            $table->string('phone');
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->text('twitter_api')->nullable();
            $table->text('google_map')->nullable();
            $table->text('icon')->nullable();
            $table->text('link')->nullable();
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
        Schema::dropIfExists('websites');
    }
}
