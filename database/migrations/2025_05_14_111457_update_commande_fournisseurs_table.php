<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommandeFournisseursTable extends Migration
{
    public function up()
    {
        Schema::table('commande_fournisseurs', function (Blueprint $table) {
            // // Suppression des anciennes colonnes si besoin
            // $table->dropForeign(['utilisateur_id']);
            // $table->dropColumn('utilisateur_id');

            // $table->dropForeign(['depot_id']);
            // $table->dropColumn('depot_id');

            // $table->dropColumn('type');
            // $table->dropColumn('remarque');

            // // Ajout des nouvelles colonnes
            // $table->unsignedBigInteger('id_depot');
            // $table->unsignedBigInteger('id_fournisseur');
            // $table->date('date_commande');
            // $table->string('statut')->default('en cours');

            // // Déclaration des clés étrangères
            // $table->foreign('id_depot')->references('id')->on('depots')->onDelete('cascade');
            // $table->foreign('id_fournisseur')->references('id')->on('fournisseurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('commande_fournisseurs', function (Blueprint $table) {
            $table->dropForeign(['id_depot']);
            $table->dropForeign(['id_fournisseur']);

            $table->dropColumn(['id_depot', 'id_fournisseur', 'date_commande', 'statut']);

            // (optionnel) Réajouter les anciennes colonnes si rollback
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('depot_id');
            $table->string('type');
            $table->text('remarque')->nullable();
        });
    }
}