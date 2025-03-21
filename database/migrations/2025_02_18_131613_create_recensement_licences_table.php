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
        Schema::create('recensement_licences', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('bien_id')->constrained()->onUpdate('cascade');
            $table->foreignId('annee_id')->constrained()->onUpdate('cascade');
            $table->String('Date_rdv');
            $table->String('Date_recensement');
            $table->string('categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensement_licences');
    }
};
