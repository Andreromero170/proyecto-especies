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
        Schema::create('taxonomias', function (Blueprint $table) {
            $table->id();
            $table->string('reino');
            $table->string('filo_division');
            $table->string('clase');
            $table->string('orden');
            $table->string('familia');
            $table->string('genero');
            $table->string('slug')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxonomias');
    }
};