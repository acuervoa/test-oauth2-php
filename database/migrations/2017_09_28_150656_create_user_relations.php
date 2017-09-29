<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('film_id');
            $table->string('user_id');
            $table->integer('vote')->nullable();
            $table->timestamps();
        });

        Schema::create('actor_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actor_id');
            $table->string('user_id');
            $table->integer('vote')->nullable();
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
        Schema::dropIfExists('film_user');
        Schema::dropIfExists('actor_user');
    }
}
