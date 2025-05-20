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
        Schema::create('sortie_vers_patients', function (Blueprint $table) {
    $table->id('id_sortie_vers_patient');
    $table->foreignId('id_patient')->constrained('patients', 'id_patient');
    $table->date('date_sortie');
    $table->foreignId('id_depot')->constrained('depots', 'id_depot');
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
        Schema::dropIfExists('sortie_vers_patients');
    }
};
