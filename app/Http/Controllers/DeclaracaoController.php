<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use Illuminate\Http\Request;
use App\Repositories\DeclaracaoRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\ComprovantesRepository;

class ProofController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new DeclaracaoRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['aluno', 'comprovante']);
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
        $aluno = (new AlunoRepository())->findById($request->aluno_id);
        $comprovante = (new ComprovantesRepository())->findById($request->comprovante_id);

        if(isset($aluno, $comprovante)){
            $data = new Declaracao;

            $data->hash = $request->hash;

            $data->date = $request->date;

            $data->aluno()->associate($aluno);

            $data->comprovante()->associate($comprovante);

            $this->repository->save($data);

            return "Comprovante gerado com sucesso";
        }

        return "Aluno ou comprovante não encontrado!!";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        
        if (isset($data)) {

            $aluno = (new AlunoRepository())->findById($data->user_id);

            $comprovante = (new ComprovantesRepository())->findById($data->user_id);

            if (isset($aluno, $comprovante)) {

                $data->aluno()->associate($aluno);    
                $data->comprovante()->associate($comprovante);
                
                return $data;
            }
        }
        
        return "A declaração não foi encontrada!!";
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
