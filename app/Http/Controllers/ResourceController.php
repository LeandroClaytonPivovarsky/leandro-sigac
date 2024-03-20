<?php

namespace App\Http\Controllers;

use App\Models\resource;
use App\Repositories\ResourceRepository;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    protected $repository;

    public function __construct() {
        $this->repository = new ResourceRepository();
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
        $newData = new Resource();
        $newData = mb_strtoupper($request->nome);
        
        $msg = "";

        $this->repository->save($newData) == false 
        ? $msg = "O RECURSO $request->nome FOI SALVO COM SUCESSO" 
        : $msg = "O RECURSO NÃO PÔDE SER INSERIDO";
        
        return $msg;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->findById($id);
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
        $data = $this->repository->findById($id);

        if (isset($data)) {
            $data = mb_strtoupper($request->nome);

            $this->repository->save($data);

            return "Alterado com sucesso";
        }

        return "Não foi encontrado nenhuma inserção com o que foi passado";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $msg = "";
        $this->repository->delete($id)
            ? $msg = "Deletado com sucesso"
            : $msg = "Não foi encontrado nenhuma inserção com o que foi passado";

        return $msg;
    }
}
