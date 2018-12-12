<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('whats_app');
            $table->string('email');
            $table->string('image');
            $table->enum('type',['ad','market']);
            $table->text('categories')->nullable(); //array
            $table->text('sub_categories')->nullable(); //array
            $table->boolean('appear_on_home')->default(false);
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
        Schema::dropIfExists('banners');
    }
}
