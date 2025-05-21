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
        Schema::create('detail_sortie_patients', function (Blueprint $table) {
    $table->id('id_detail_sortie_patient');
    $table->foreignId('id_sortie_vers_patient')->constrained('sortie_vers_patients', 'id_sortie_vers_patient');
    $table->foreignId('id_produit')->constrained('produits', 'id_produit', 'id');
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
        Schema::dropIfExists('detail_sortie_patients');
    }
};
