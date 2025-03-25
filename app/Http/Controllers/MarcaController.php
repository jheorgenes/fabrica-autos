<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use App\Services\MarcaService;

class MarcaController extends Controller
{
    public function __construct(protected MarcaService $marcaService) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = $this->marcaService->listar();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaRequest $request)
    {
        $this->marcaService->criar($request->validated());
        return redirect()->route('marcas.index')->with('success', 'Marca cadastrada com sucesso!');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaRequest  $request
     * @param   Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        $this->marcaService->atualizar($marca, $request->validated());
        return redirect()->route('marcas.index')->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $this->marcaService->excluir($marca);
        return redirect()->route('marcas.index')->with('success', 'Marca excluída com sucesso!');
    }
}
