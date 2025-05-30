<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cmd_depot', function (Blueprint $table) {
            $table->enum('type_commande', [
                'bon mensuelle',
                'bon retour',
                'bon échange',
                'bon décharge',
                'bon ordonnance',
                'bon supplémentaire'
            ])->nullable()->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cmd_depot', function (Blueprint $table) {
            $table->dropColumn('type_commande');
        });
    }
};
