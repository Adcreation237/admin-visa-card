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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idseller');
            $table->unsignedBigInteger('idcard');
            $table->string('annee');
            $table->string('mois');
            $table->string('jour');
            $table->string('qte');
            $table->string('montant');
            $table->timestamps();

            $table->foreign('idseller')->references('id')->on('acteurs')->onDelete('cascade');
            $table->foreign('idcard')->references('id')->on('serie_cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
        Schema::create('ventes', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('ventes_id_foreign');
        });
    }
};
