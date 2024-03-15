<?php

namespace App\Facilitador;

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
        Schema::create('alunos', function (Blueprint $table) {
            $facilitador = new Facilitador($table);

            $table->id();
            $table->string('nome');
            $table->string('cpf');
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('turma_id');
            $facilitador->chaveEstrangeira('user_id', 'users');
            $facilitador->chaveEstrangeira('curso_id','cursos');
            $facilitador->chaveEstrangeira('turma_id', 'turmas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
