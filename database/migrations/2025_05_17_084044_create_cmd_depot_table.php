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
        Schema::create('cmd_depot', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('depot_source_id');
    $table->unsignedBigInteger('depot_dest_id');
    $table->date('date_cmd');
    $table->string('statut')->default('en attente');
    $table->timestamps();

    $table->foreign('depot_source_id')->references('id_depot')->on('depots')->onDelete('cascade');
    $table->foreign('depot_dest_id')->references('id_depot')->on('depots')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cmd_depot');
    }
};
