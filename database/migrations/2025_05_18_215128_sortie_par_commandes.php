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
    Schema::create('sortie_par_commandes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_cmd_depot')->constrained('cmd_depot', 'id');
        $table->foreignId('id_sortie_depot')->constrained('sortie_depots', 'id_sortie_depot');
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
        Schema::dropIfExists('sortie_par_commandes');
    }
};
