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
        Schema::create('turmas', function (Blueprint $table) {
            $facilitador = new Facilitador($table);
            
            $table->id();
            $table->integer('ano');
            $table->unsignedBigInteger('id_eixo');
            $facilitador->chaveEstrangeira('curso_id', 'cursos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
