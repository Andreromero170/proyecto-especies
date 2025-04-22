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
        Schema::create('especies', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['flora', 'fauna']);
            $table->string('nombre_cientifico');
            $table->string('nombre_vernaculo');
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->string('ubicacion');
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada', 'modificada'])->default('pendiente');
            $table->foreignId('taxonomia_id')->constrained('taxonomias')->onDelete('cascade');
            $table->foreignId('alumno_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies');
    }
};
