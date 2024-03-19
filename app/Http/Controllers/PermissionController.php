<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    protected $repository;

    public function __construct() {
        $this->repository = new PermissionRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith(['role', 'resource']);
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
        $role = (new RoleRepository())->findById($request->role_id);
        $resource = (new ResourceRepository())->findById($request->resource_id);

        if (isset($resource, $role)) {
            $newData = new Permission();

            $newData->role()->associate($role);

            $newData->resource()->associate($resource);

            $newData->permission = $request->permission;

            $this->repository->save($newData);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);

        if (isset($data)){
            $role = (new RoleRepository())->findById($data->role_id);
            $resource = (new ResourceRepository())->findById($data->resource_id);

            if (isset($resource, $role)){
                
                $data->role()->associate($role);

                $data->resource()->associate($resource);

                return $data;
            }
    
        }
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

        if (isset($data)){
            $role = (new RoleRepository())->findById($request->role_id);
            $resource = (new ResourceRepository())->findById($request->resource_id);

            if (isset($resource, $role)){
                
                $data->role()->associate($role);

                $data->resource()->associate($resource);

                $data = $request->permission;

                $this->repository->save($data);

                return "Objeto salvo com sucesso";
            }
    
        }

        return "Não foi possivel encontrar o objeto";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $msg = "";
        
        $this->repository->delete($id) == false
            ? $msg = "Deletado com sucesso!"
            : $msg = "Não foi possível deletar o objeto";

        return $msg;
        
    }
}
