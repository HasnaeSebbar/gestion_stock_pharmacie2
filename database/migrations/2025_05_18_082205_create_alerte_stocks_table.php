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
        Schema::create('alerte_stocks', function (Blueprint $table) {
    $table->id('id_alert');
    $table->unsignedBigInteger('id_depot');
    $table->unsignedBigInteger('id_produit');
    $table->string('type_alert');
    $table->date('date_alert');
    $table->timestamps();

    $table->foreign('id_depot')->references('id_depot')->on('depots')->onDelete('cascade');
    $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerte_stocks');
    }
};
