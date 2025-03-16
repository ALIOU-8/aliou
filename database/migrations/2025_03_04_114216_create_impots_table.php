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
            $table->foreignId('annee_id')->constrained()->onUpdate('cascade');
            $table->foreignId('recensement_cfu_id')->nullable()->on('recensement_cfus')->onDelete('cascade');
            $table->foreignId('recensement_tpu_id')->nullable()->on('recensement_tpus')->onDelete('cascade');
            $table->foreignId('recensement_patente_id')->nullable()->on('recensement_patentes')->onDelete('cascade');
            $table->foreignId('recensement_licence_id')->nullable()->on('recensement_licences')->onDelete('cascade');
            $table->string('statut');
            $table->integer('montant_brute');
            $table->integer('montant_a_payer');
            $table->date('date_limite');
            $table->string('role');
            $table->string('article');
            $table->integer('base_imposition');
            $table->integer('imposition_anterieur');
            $table->integer('penalite');
            $table->string('droit_fixe')->nullable();
            $table->string('droit_proportionnel')->nullable();
            $table->string('numero')->unique();
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
