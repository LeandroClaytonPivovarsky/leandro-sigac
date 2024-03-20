<?php

namespace App\Http\Controllers;

use App\Repositories\CursoRepository;
use Illuminate\Http\Request;
use App\Repositories\CategoriaRepository;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['curso']);
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
        $curso = (new CursoRepository())->findById($request->curso_id);

        if (isset($curso)) {
            $data = new Categoria();

            $data->nome = mb_strtoupper($request->nome);

            $data->maximo_horas = $request->maximo_horas;
            
            $data->curso()->associate($curso);

            $this->repository->save($data);

            return "A Categoria $request->nome Foi cadastrada com sucesso";

        }

        return "Ocorreu um erro ao identificar o curso!!";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        
        if (isset($data)) {

            $curso = (new CursoRepository())->findById($data->curso_id);
            if (isset($curso)) {
 
                $data->curso()->associate($curso);
                
                return $data;
            }
        }
        
        return "A Categoria não foi encontrada!!";
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
        $data = $this->repository->findById($id);

        $nomeAntigo = $data->nome;

        if (isset($data)) {

            $curso = (new CursoRepository())->findById($request->curso_id);

            if (isset($curso)) {

                $data->nome = mb_strtoupper($request->nome);

                $data->maximo_horas = $request->maximo_horas;
                
                $data->curso()->associate($curso);

                $this->repository->save($data);
                
                return "A Categoria $nomeAntigo foi alterado Para $data->nome com sucesso";
            }
            return "Alguma informação foi inserida errada";
        }

        return "Não foi encontrado nenhuma categoria!!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->repository->findById($id);

        if (isset($data)) {
            $nomeCategoria = $data->nome;
            $this->repository->delete($id);

            return "A categoria $nomeCategoria foi excluida com sucesso";
        }

        return "Não há nada para ser excluído com estas informações";
    }
}
