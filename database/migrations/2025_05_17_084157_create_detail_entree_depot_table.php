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
        Schema::create('detail_entree_depot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entree_depot_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite_recue');
            $table->timestamps();

            $table->foreign('entree_depot_id')->references('id')->on('entree_depot')->onDelete('cascade');
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
        Schema::dropIfExists('detail_entree_depot');
    }
};
