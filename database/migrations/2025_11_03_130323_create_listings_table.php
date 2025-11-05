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
        Schema::create('listings', function (Blueprint $table) {
            $table->id(); // Automatische Primärschlüssel-ID
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Besitzer des Listings
            $table->string('name'); // Name des Artikels
            $table->text('beschreibung'); // Beschreibung des Artikels
            $table->decimal('preis', 10, 2); // Preis des Artikels
            $table->timestamps(); // Erstellt created_at & updated_at Spalten
            $table->softDeletes(); // Fügt ein deleted_at-Feld hinzu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
