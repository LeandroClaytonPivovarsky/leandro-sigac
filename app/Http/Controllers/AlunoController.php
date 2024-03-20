<?php

namespace App\Http\Controllers;

use App\Repositories\AlunoRepository;
use App\Models\Aluno;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new AlunoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['user', 'curso', 'turma']);
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
        $user = (new UserRepository())->findById($request->user_id);
        $curso = (new CursoRepository())->findById($request->curso_id);
        $turma = (new TurmaRepository())->findById($request->turma_id);
        
        if (isset($user, $turma, $curso)) {
            $data = new Aluno();

            $data->nome = mb_strtoupper($request->nome);

            $data->cpf = mb_strtoupper($request->cpf);

            $data->email = mb_strtoupper($request->email);

            $data->password = $request->password;

            $data->user()->associate($user);
            
            $data->curso()->associate($curso);

            $data->turma()->associate($turma);

            $this->repository->save($data);

            return "O aluno $request->nome Foi cadastrado com sucesso";

        }

        return "Alguma informação foi digitada errada!!";
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        
        if (isset($data)) {

            $user = (new UserRepository())->findById($data->user_id);

            $turma = (new TurmaRepository())->findById($data->user_id);

            $curso = (new CursoRepository())->findById($data->curso_id);
            if (isset($curso,$turma,$user)) {

                $data->user()->associate($user);    
                $data->curso()->associate($curso);
                $data->turma()->associate($turma);
                
                return $data;
            }
        }
        
        return "O Aluno não foi encontrado!!";
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

        $nomeAntigo = $data->nome;

        if (isset($data)) {

            $user = (new UserRepository())->findById($request->user_id);

            $turma = (new TurmaRepository())->findById($request->turma_id);

            $curso = (new CursoRepository())->findById($request->curso_id);

            if (isset($curso,$turma,$user)) {

                $data->nome = mb_strtoupper($request->nome);

                $data->cpf = mb_strtoupper($request->cpf);

                $data->email = mb_strtoupper($request->email);

                $data->password = $request->password;

                $data->user()->associate($user);  
                
                $data->curso()->associate($curso);

                $data->turma()->associate($turma);

                $this->repository->save($data);
                
                return "O Usuário $nomeAntigo foi alterado Para $data->nome com sucesso";
            }
            return "Alguma informação foi inserida errada";
        }

        return "Não foi encontrado nenhum aluno!!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->repository->findById($id);

        if (isset($data)) {
            $nomeAluno = $data->nome;
            $this->repository->delete($id);

            return "O $nomeAluno foi excluido com sucesso";
        }

        return "Não há nada para ser excluído com estas informações";

    }
}
