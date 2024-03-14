<?php

namespace App\Facilitador;

use Illuminate\Database\Schema\Blueprint;


class Facilitador{


    protected $table;

    public function __construct(Blueprint $table) {
        $this->table = $table;
    }

    public function chaveEstrangeira($nomeCampo, $nomeTabela)
    {
        return $this->table->foreign($nomeCampo)->references('id')->on($nomeTabela);
    }
}