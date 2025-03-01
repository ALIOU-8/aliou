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
        Schema::create('recensement_cfus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('bien_id')->constrained()->onUpdate('cascade');
            $table->foreignId('annee_id')->constrained()->onUpdate('cascade');
            $table->string('statut');
            $table->string('type');
            $table->date('date_rdv');
            $table->date('date_recensement');
            $table->integer('nbre_etage');
            $table->float('surface');
            $table->string('nature_fondation');
            $table->string('nature_mur');
            $table->string('nature_toit');
            $table->integer('nombre_unite');
            $table->integer('nombre_unite_occuper');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensement_cfus');
    }
};
