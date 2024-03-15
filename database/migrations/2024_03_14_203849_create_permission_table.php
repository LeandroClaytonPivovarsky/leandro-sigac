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
        Schema::create('permissions', function (Blueprint $table) {
            $facilitador = new Facilitador($table);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('resource_id');
            $table->boolean('permission');
            $facilitador->chaveEstrangeira('role_id','roles');
            $facilitador->chaveEstrangeira('resource_id','resources');
            $table->primary(['role_id', 'resource_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
