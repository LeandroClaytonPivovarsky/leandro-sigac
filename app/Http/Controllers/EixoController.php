<?php

namespace App\Http\Controllers;

use App\Repositories\EixoRepository;

use App\Models\Eixo;

use Illuminate\Http\Request;

class EixoController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new EixoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAll();
        return $data;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $objeto = new Eixo;
        $objeto->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($objeto);
        return "<h1>Objeto $objeto->nome salvo com sucesso!!</h1>";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $objeto = $this->repository->findById($id);
        $nomeAntigo = $this->repository->findById($id);

        if (isset($objeto)) {
            $objeto->nome = mb_strtoupper($request->nome, 'UTF-8');
            $this->repository->save($objeto);
            return "<H1>OBJETO $nomeAntigo->nome ALTERADO COM SUCESSO PARA $objeto->nome</H1>";
        }
        return "<H1>OBJETO NÃO ENCONTRADO";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->repository->delete($id)) {
            return "<h1>OBJETO DE ID $id- DELETADO</h1>";
        }
        return "<h1>OBJETO COM ID $id - NÃO FOI NEM ENCONTRADO</h1>";
    }
}
