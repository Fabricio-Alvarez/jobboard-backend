<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->string('job_title'); // Título del Puesto
            $table->text('description'); // Descripción
            $table->string('location'); // Ubicación
            $table->decimal('salary', 10, 2); // Salario
            $table->string('category'); // Categoría
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario (reclutador)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers');
    }
};
