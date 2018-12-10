<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users' , function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->default('[]'); //array
            $table->enum('gender' , ['male' , 'female']);
            $table->string('birthday')->nullable();
            $table->integer('free_credit')->default(0);
            $table->text('social_media')->nullable(); //array
            $table->string('verification_code')->nullable();
            $table->boolean('active')->default(false);
            $table->string('activation_token')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('all_time_habits')->default('[]');
            $table->string('used_coupons')->default('[]');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
