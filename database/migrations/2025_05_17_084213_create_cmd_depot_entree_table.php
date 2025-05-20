<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('cmd_depot_entree', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('cmd_depot_id');
    $table->unsignedBigInteger('entree_depot_id');
    $table->timestamps();

    $table->foreign('cmd_depot_id')->references('id')->on('cmd_depot')->onDelete('cascade');
    $table->foreign('entree_depot_id')->references('id')->on('entree_depot')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cmd_depot_entree');
    }
};
