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
        Schema::create('occupants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('recensement_cfu_id')->constrained('recensement_cfus')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('niveau');
            $table->string('unite');
            $table->string('activite');
            $table->integer('valeur_locative');
            $table->text('observation');
            $table->string('type_occupant');
            $table->string("delete")->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupants');
    }
};
