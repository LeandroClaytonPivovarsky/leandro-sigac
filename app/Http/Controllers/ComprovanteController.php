<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Repositories\AlunoRepository;
use App\Repositories\ComprovantesRepository;
use App\Repositories\DeclaracaoRepository;
use Illuminate\Http\Request;

class DeclarationController extends Controller
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
        $data = $this->repository->selectAllWith(['aluno', 'comprovante']);
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
