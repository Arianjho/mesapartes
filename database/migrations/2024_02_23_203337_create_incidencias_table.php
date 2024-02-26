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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('ruc')->nullable();
            $table->date('fecha')->nullable();
            $table->text('razonsocial')->nullable();
            $table->string('documento')->nullable();
            $table->string('tipodocumento')->nullable();
            $table->string('serie')->nullable();
            $table->string('correlativo')->nullable();
            $table->string('valordigerido')->nullable();
            $table->string('coderror')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
