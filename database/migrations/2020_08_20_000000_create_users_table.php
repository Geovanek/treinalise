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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('company_owner_id')->nullable();
            $table->foreign('company_owner_id')->references('id')->on('companies');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('cpf',11)->nullable();
            $table->char('sex',1)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('height', 65, 2)->nullable();
            $table->string('avatar', 250)->nullable();
            $table->bigInteger('strava_id')->nullable();
            $table->string('strava_access_token')->nullable();
            $table->string('strava_refresh_token')->nullable();
            $table->integer('strava_access_token_expires_at')->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('users');
    }
}
