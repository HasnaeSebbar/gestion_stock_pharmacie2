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
Schema::create('detail_cmd', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('cmd_depot_id');
    $table->unsignedBigInteger('produit_id');
    $table->integer('quantite_cmd');
    $table->timestamps();

    $table->foreign('cmd_depot_id')->references('id')->on('cmd_depot')->onDelete('cascade');
    $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_cmd');
    }
};
