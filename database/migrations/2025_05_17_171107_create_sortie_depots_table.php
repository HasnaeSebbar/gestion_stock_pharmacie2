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
        Schema::create('sortie_depots', function (Blueprint $table) {
    $table->id('id_sortie_depot');
    $table->date('date_sortie');
    $table->foreignId('id_depot_source')->constrained('depots', 'id_depot');
    $table->foreignId('id_depot_destin')->constrained('depots', 'id_depot');
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
        Schema::dropIfExists('sortie_depots');
    }
};
