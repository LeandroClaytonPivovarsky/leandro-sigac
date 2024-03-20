<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use App\Repositories\DeclaracaoRepository;
use Illuminate\Http\Request;

class DeclaracaoController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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



}
