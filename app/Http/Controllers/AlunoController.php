<?php

namespace App\Http\Controllers;

use AlunosRepository;
use App\Models\Aluno;
use App\Repositories\CursoRepository;
use Illuminate\Http\Request;
use TurmasRepository;
use UsersRepository;

class AlunoController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new AlunosRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['user', 'curso', turma]);
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
        $user = (new UsersRepository())->findById($request->user_id);
        $curso = (new CursoRepository())->findById($request->curso_id);
        $turma = (new TurmasRepository())->findById($request->turma_id);
        
        if (isset($user, $turma, $curso)) {
            $data = new Aluno();

            $data->nome = mb_strtoupper($request->nome);

            $data->cpf = mb_strtoupper($request->cpf);

            $data->email = mb_strtoupper($request->email);

            $data->password = $request->password;

            $data->user()->associate($user);
            
            $data->curso()->associate($curso);

            $data->turma()->associate($turma);

            $this->repository->store($data);

            return "O aluno $request->nome Foi cadastrado com sucesso";

        }

        return "Alguma informação foi digitada errada!!";
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
