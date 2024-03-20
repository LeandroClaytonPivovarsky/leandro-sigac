<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\CursoRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['curso', 'role']);
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
        $curso = (new CursoRepository())->findById($request->curso_id);
        $role = (new RoleRepository())->findById($request->role_id);

        if (isset($curso)) {
            $data = new User();

            $data->nome = mb_strtoupper($request->nome);

            $data->email = mb_strtoupper($request->email);

            $data->password = $request->password;
            
            $data->curso()->associate($curso);

            $data->role()->associate($role);

            $this->repository->save($data);

            return "O usuer $request->nome foi cadastrada com sucesso";

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

            $curso = (new CursoRepository())->findById($data->curso_id);

            $role = (new RoleRepository())->findById($data->role_id);

            if (isset($curso, $role)) {
 
                $data->curso()->associate($curso);

                $data->role()->associate($role);
                
                return $data;
            }
        }
        
        return "O user não foi encontrado!!";
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

            $curso = (new CursoRepository())->findById($request->curso_id);
            $role = (new RoleRepository())->findById($request->role);

            if (isset($curso, $role)) {

                $data->nome = mb_strtoupper($request->nome);

                $data->password = $request->password;
                
                $data->curso()->associate($curso);

                $data->role()->associate($role);

                $this->repository->save($data);
                
                return "O user $nomeAntigo foi alterado para $data->nome com sucesso";
            }
            return "Alguma informação foi inserida errada";
        }

        return "Não foi encontrado nenhum usuário!!";
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

            return "O user $nomeAluno foi excluido com sucesso";
        }

        return "Não há nada para ser excluído com estas informações";
    }
}
