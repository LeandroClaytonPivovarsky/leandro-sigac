<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Repositories\CursoRepository;
use App\Repositories\EixoRepository;
use App\Repositories\NivelRepository;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    protected $repository;

    public function __construct() {
        $this->repository = new CursoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAllWith(['eixo', 'nivel']);
        return $data;
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
        $eixo = (new EixoRepository())-> findById($request->eixo_id);
        $nivel = (new NivelRepository())->findById($request->nivel_id);

        if (isset($nivel) && isset($eixo)) {
            $data = new Curso();

            $data->nome = mb_strtoupper($request->nome, 'UTF-8');

            $data->sigla = mb_strtoupper($request->sigla, 'UTF-8');

            $data->total_horas = $request->total_horas;

            $data->eixo()->associate($eixo);

            $data->nivel()->associate($nivel);

            $this->repository->save($data);

            return "<h1>OS DADOS DE $data->nome </h1>";

        }

        return "<h1>Não foi achado o Eixo e/ou o Nível</h1>";
    }

    /**
     * Display the specified resource.
     */ 
    public function show(string $id)
    {       
        $data = $this->repository->findById($id);
        if (isset($data)) {
            $eixo = $this->repository->findById($data->eixo_id);
            $nivel = $this->repository->findById($data->nivel_id);
            
            if (isset($eixo) && isset($nivel)) {
                $data->eixo()->associate($eixo);
                $data->nivel()->associate($nivel);
                return $data;
            }
        }



        return "Não foi encontrado nenhum dado sobre esse ID";

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

        if (!isset($data)) {
            return "NÃO FOI ACHADO NENHUM CURSO COM ESAS ESPECIFICAÇÕES";
        }

        $nomeAntigo = $data->nome;

        $eixo = $this->repository->findById($request->eixo_id);
        
        $nivel = $this->repository->findById($request->nivel_id);

        if (isset($eixo) && isset($nivel)) {
            $data->nome = mb_strtoupper($request->nome, 'UTF-8');

            $data->sigla = mb_strtoupper($request->sigla, 'UTF-8');

            $data->total_horas = $request->total_horas;

            $data->eixo()->associate($eixo);

            $data->nivel()->associate($nivel);

            $this->repository->save($data);

            return "O objeto $nomeAntigo foi alterado com sucesso!!";

        }

        return "NÃO FORAM ENCONTRADOS OS EIXOS E OS NÍVEIS ESPECIFICADOS";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $this->repository->delete($id);

        if ($this->repository->findById($id) == null) {
            return "Excluído com sucesso";
        }

        return "NÃO FOI POSSÍVEL EXCLUIR";
        
    }
}
