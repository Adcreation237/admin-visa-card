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
        Schema::create('visa_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idrespo');
            $table->unsignedBigInteger('idreceive');
            $table->string('segment_card');
            $table->string('date_start');
            $table->string('num_bank');
            $table->string('branch_partner');
            $table->string('branch_distri');
            $table->string('first_num');
            $table->string('last_num');
            $table->timestamps();

            $table->foreign('idrespo')->references('id')->on('acteurs')->onDelete('cascade');
            $table->foreign('idreceive')->references('id')->on('acteurs')->onDelete('cascade');
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
        Schema::dropIfExists('visa_cards');
        Schema::create('visa_cards', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('demandes_id_foreign');
        });
    }
};
