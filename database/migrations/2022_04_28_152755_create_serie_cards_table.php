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
        Schema::create('serie_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idcard');
            $table->string('num_card');
            $table->timestamps();

            $table->foreign('idcard')->references('id')->on('visa_cards')->onDelete('cascade');

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
        Schema::dropIfExists('serie_cards');
        Schema::create('serie_cards', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('serie_cards_id_foreign');
        });
    }
};