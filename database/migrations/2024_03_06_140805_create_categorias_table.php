<?php

use App\Facilitador\Facilitador;
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
        Schema::create('categorias', function (Blueprint $table) {
            $facilitador = new Facilitador($table);
            $table->id();
            $table->string('nome');
            $table->float('maximo_horas');
            $table->unsignedBigInteger('curso_id');
            $facilitador->chaveEstrangeira('curso_id', 'cursos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
