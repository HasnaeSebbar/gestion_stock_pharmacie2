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
        Schema::create('detail_sortie_internes', function (Blueprint $table) {
    $table->id('id_detail_interne');
    $table->foreignId('id_sortie_interne')->constrained('sortie_internes', 'id_sortie_interne');
    $table->foreignId('id_produit')->constrained('produits', 'id');
    $table->integer('quantite');
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
        Schema::dropIfExists('detail_sortie_internes');
    }
};
