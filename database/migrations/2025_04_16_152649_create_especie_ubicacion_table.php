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
        Schema::create('especie_ubicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especie_id')->constrained('especies')->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['especie_id', 'ubicacion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especie_ubicacion');
    }
};
