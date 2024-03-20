<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Repositories\NivelRepository;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new NivelRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $objeto = new Nivel();
        $objeto->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($objeto);
        return "<h1>NIVEL \"$objeto->nome\" CRIADO COM SUCESSO</h1>";

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $objeto = $this->repository->findById($id);
        return $objeto;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $objeto = $this->repository->findById($id);
        if(isset($objeto)){
            $nomeAntigo = $this->repository->findById($id)->nome;
            $objeto->nome = mb_strtoupper($request->nome, 'UTF-8');
            $this->repository->save($objeto);
            return "<h1>O OBJETO \"$nomeAntigo\" \nFOI ALTERADO PARA\n \"$objeto\" COM SUCESSO!!</h1>";
        }

        return 'NÃO FOI ENCONTRADO OBJETO COM ESTE ID';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $mensagem = "";

        $this->repository->delete($id) 
            ?   $mensagem = "O OBJETO DE ID $id FOI DELETADO"
            :   $mensagem = "NÃO FOI ENCONTRADO NENHUM BOJETO COM ESTE ID";

        return $mensagem;


    }
}
