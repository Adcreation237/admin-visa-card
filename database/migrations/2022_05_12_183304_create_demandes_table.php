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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddemandeur');
            $table->string('segment');
            $table->string('nbre_card');
            $table->string('statut');
            $table->timestamps();

            $table->foreign('iddemandeur')->references('id')->on('acteurs')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
        Schema::create('demandes', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('demandes_id_foreign');
        });
    }
};
