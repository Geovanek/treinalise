<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extension_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extension_id');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('extension_id')
                        ->references('id')
                        ->on('extensions')
                        ->onDelete('cascade');
            $table->foreign('plan_id')
                        ->references('id')
                        ->on('plans')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extension_plan');
    }
}
