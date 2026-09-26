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
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->unsignedInteger('altezza')->nullable();
            $table->unsignedInteger('peso')->nullable();
            $table->string('colore_capelli')->nullable();
            $table->string('colore_occhi')->nullable();
            $table->string('anno_nascita')->nullable();
            $table->string('genere')->nullable();
            $table->string('immagine')->nullable();
            $table->foreignId('planet_id')->nullable()->constrained('planets')->nullOnDelete();
            $table->foreignId('species_id')->nullable()->constrained('species')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
