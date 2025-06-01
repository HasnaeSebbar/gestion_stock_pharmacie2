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
        Schema::create('entree_depot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_depot');
            $table->date('date_entree');
            $table->foreign('id_depot')->references('id_depot')->on('depots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entree_depot');
    }
};
