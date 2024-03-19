<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Repositories\CursoRepository;
use App\Repositories\TurmasRepository;
use Illuminate\Http\Request;

class TurmaController extends Controller
{

    protected $repository;

    public function __construct()  {
        $this->repository = new TurmasRepository();
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
            
        }
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
