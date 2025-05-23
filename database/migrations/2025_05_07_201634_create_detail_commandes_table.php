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
    Schema::create('detail_commandes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('commande_id');
        $table->unsignedBigInteger('produit_id');
        $table->integer('quantite');
        $table->timestamps();

        $table->foreign('commande_id')->references('id')->on('commande_fournisseurs')->onDelete('cascade');
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
        Schema::dropIfExists('detail_commandes');
    }
};
