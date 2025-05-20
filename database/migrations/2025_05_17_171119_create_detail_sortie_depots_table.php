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
        Schema::create('detail_sortie_depots', function (Blueprint $table) {
    $table->id('id_detail_sortie_depot');
    $table->foreignId('id_sortie_depot')->constrained('sortie_depots', 'id_sortie_depot');
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
        Schema::dropIfExists('detail_sortie_depots');
    }
};
