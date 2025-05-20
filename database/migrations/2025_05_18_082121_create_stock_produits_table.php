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
        Schema::create('stock_produits', function (Blueprint $table) {
    $table->unsignedBigInteger('id_stock');
    $table->unsignedBigInteger('id_produit');
    $table->integer('quantite_initial');
    $table->integer('seuil_alerte');
    $table->integer('seuil_alerte_reactif');
    $table->timestamps();

    $table->primary(['id_stock', 'id_produit']);

    $table->foreign('id_stock')->references('id_stock')->on('stocks')->onDelete('cascade');
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
        Schema::dropIfExists('stock_produits');
    }
};
