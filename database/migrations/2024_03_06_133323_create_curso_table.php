<?php

namespace App\Facilitador;

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
        Schema::create('cursos', function (Blueprint $table) {
            $facilitador = new Facilitador($table);

            $table->id();
            $table->string('nome');
            $table->string('sigla');
            $table->integer('total_horas');
            $table->unsignedBigInteger('nivel_id');
            $table->unsignedBigInteger('eixo_id');
            $facilitador->chaveEstrangeira('nivel_id','niveis');
            $facilitador->chaveEstrangeira('eixo_id','eixos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};