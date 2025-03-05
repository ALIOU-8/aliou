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
        Schema::create('impots', function (Blueprint $table) {
            $table->id();
            $table->string('type_impot');

            $table->unsignedBigInteger('recensement_cfu_id')->nullable();
            $table->foreign('recensement_cfu_id')->references('id')->on('recensement_cfus')->onDelete('cascade');

            $table->unsignedBigInteger('recensement_tpu_id')->nullable();
            $table->foreign('recensement_tpu_id')->references('id')->on('recensement_tpus')->onDelete('cascade');

            $table->unsignedBigInteger('recensement_patente_id')->nullable();
            $table->foreign('recensement_patente_id')->references('id')->on('recensement_patentes')->onDelete('cascade');

            $table->unsignedBigInteger('recensement_licence_id')->nullable();
            $table->foreign('recensement_licence_id')->references('id')->on('recensement_licences')->onDelete('cascade');

            $table->string('statut');
            $table->integer('montant_brute');
            $table->integer('montant_a_payer');
            $table->date('date_limite');
            $table->string('role');
            $table->string('article');
            $table->integer('base_imposition');
            $table->integer('imposition_anterieur');
            $table->integer('penalite');
            $table->string('droit_fixe');
            $table->string('droit_proportionnel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impots');
    }
};
