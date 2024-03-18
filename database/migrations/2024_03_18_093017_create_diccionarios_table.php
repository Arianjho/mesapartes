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
        Schema::create('diccionarios', function (Blueprint $table) {
            $table->id();

            $table->integer('coderror')->unique();
            $table->text('descripcion')->nullable();
            $table->text('tipodocumento')->nullable();
            $table->text('detalle')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diccionarios');
    }
};
