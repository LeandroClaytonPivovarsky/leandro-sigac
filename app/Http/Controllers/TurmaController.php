<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use Illuminate\Http\Request;

class TurmaController extends Controller
{

    protected $repository;

    public function __construct()  {
        $this->repository = new TurmaRepository();
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
            $newData = new Turma();

            $newData->curso()->associate($curso);

            $newData->ano = $request->ano;

            $this->repository->save($newData);

            return "A TURMA DO ANO $request->ano FOI CADASTRADA";

        }

        return "NÃO FOI POSSÍVEL CADASTRAR O ANO!!";
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

        return "NÃO FOI POSSÍVEL ENCONTRAR ESSA PILANTRAGEM";
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

        $antigoAno = $data->ano;

        if (isset($data)) {
            $curso = (new CursoRepository())->findById($request->curso_id);

            if (isset($curso)) {
                
                $data->curso()->associate($curso);

                $data->ano = $request->ano;
    
                $this->repository->save($data);
                return "O ano foi alterado de $antigoAno para $data->ano";
            }
        }
        return "Alguma informação está incorreta";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $msg = "";
        $this->repository->delete($id) 
        ? $msg = "DELETADO COM SUCESSO"
        : $msg = "NÃO FOI ENCONTRADO NENHUM OBJETO COM ESSA ESPECIFICAÇÃO";

        return $msg;
    }
}
