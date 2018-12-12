<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('type', ['ad', 'market']);
            $table->unsignedBigInteger('user_id');
            $table->string('whats_app');
            $table->string('place');
            $table->string('phone');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->default(1);
            $table->integer('views_count')->default(0);
            $table->enum('state', ['pinned', 'featured', 'none'])->default('none');
            $table->integer('order')->default(0);
            $table->string('images_url')->default('[]');
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
        Schema::dropIfExists('items');
    }
}
