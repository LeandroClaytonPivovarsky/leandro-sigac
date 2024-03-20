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

            return "A PERMISSÃO FOI CRIADA WOW";
        }

        return "NÃO FOI ENCONTRADA ALGUMA COISA";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findByCompositeIdWith(

            Permission::getKeys(),

            explode('_', $id),

            ['role', 'resource'] 
        );
        
        $msg = "";

        isset($data)
        ?   $msg = $data
        :   $msg = "Não foi encontrado essa permissão";

        return $msg;
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
        $obj = $this->repository->findByCompositeId(
            Permission::getKeys(), 
            explode("_", $id) 
        );

        if (isset($obj)){
            $role = (new RoleRepository())->findById($request->role_id);
            $resource = (new ResourceRepository())->findById($request->resource_id);

            if ($this->repository->updateCompositeId(

                    Permission::getKeys(), // keys

                    explode("_", $id), // ids

                    "permissions", // table

                    [ // values
                        "permission" => $request->permissao
                    ]

            ))
            {

                return "<h1>Update - OK!</h1>";

            }
        }

        return "Não foi possivel encontrar o objeto";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->repository->deleteCompositeId(

                Permission::getKeys(), // keys

                explode("_", $id), // ids

                "permissions" // table

        ))
        {

            return "<h1>Delete - OK!</h1>";

        }

        return "<h1>Delete - Not found Eixo!</h1>";

        
    }
}
