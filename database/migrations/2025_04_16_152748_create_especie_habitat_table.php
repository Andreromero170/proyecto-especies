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
        Schema::create('especie_habitat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especie_id')->constrained('especies')->onDelete('cascade');
            $table->foreignId('habitat_id')->constrained('habitats')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['especie_id', 'habitat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especie_habitat');
    }
};
