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
        Schema::create('declaracoes', function (Blueprint $table) {
            $facilitador = new Facilitador($table);
            
            $table->id();
            $table->string('hash');
            $table->dateTime('data');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('comprovante_id');
            $facilitador->chaveEstrangeira('comprovante_id', 'comprovantes');
            $facilitador->chaveEstrangeira('aluno_id', 'alunos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracoes');
    }
};
