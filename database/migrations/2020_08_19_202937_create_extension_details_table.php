<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extension_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extension_id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('state_color')->nullable();
            $table->foreign('extension_id')->references('id')->on('extensions')->onDelete('cascade');
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
        Schema::dropIfExists('extension_details');
    }
}
