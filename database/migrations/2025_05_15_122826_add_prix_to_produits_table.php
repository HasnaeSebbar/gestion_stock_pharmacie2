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
    // Schema::table('produits', function (Blueprint $table) {
    //     $table->decimal('prix', 10, 2)->after('nom')->nullable(); // ou ->default(0)
    // });
}

public function down()
{
    Schema::table('produits', function (Blueprint $table) {
        $table->dropColumn('prix');
    });
}

};
