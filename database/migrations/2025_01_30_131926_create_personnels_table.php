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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string("matricule")->unique();
            $table->string("nom");
            $table->string("prenom");
            $table->string("telephone")->unique();
            $table->foreignId('fonction_id')->constrained()->onUpdate('cascade');
            $table->string("hierachie");
            $table->string("delete")->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
