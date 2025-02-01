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
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribuable_id')->constrained()->onUpdate('cascade');
            $table->foreignId('type_bien_id')->constrained()->onUpdate('cascade');
            $table->string('libelle');
            $table->string('adresse');
            $table->string('numero_bien');
            $table->string('delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
