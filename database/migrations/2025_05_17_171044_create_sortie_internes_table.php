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
        Schema::create('sortie_internes', function (Blueprint $table) {
    $table->id('id_sortie_interne');
    $table->foreignId('id_depot')->constrained('depots', 'id_depot');
    $table->date('date_sortie');
    $table->string('destinataire_nom');
    $table->string('destinataire_type');
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
        Schema::dropIfExists('sortie_internes');
    }
};
