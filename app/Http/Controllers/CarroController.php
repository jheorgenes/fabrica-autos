<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;
use App\Models\Carro;
use App\Services\CarroService;
use Illuminate\Http\Request;

class CarroController extends Controller
{

    public function __construct(protected CarroService $carroService) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carros = $this->carroService->listar();
        return view('carros.index', compact('carros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modelos = $this->carroService->listarModelos();
        return view('carros.create', compact('modelos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarroRequest $request)
    {
        try {
            $this->carroService->criar($request->validated());
            return redirect()->route('carros.index')->with('success', 'Carro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
     * @param  Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function edit(Carro $carro)
    {
        $modelos = $this->carroService->listarModelos();
        return view('carros.edit', compact('carro', 'modelos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarroRequest  $request
     * @param  Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarroRequest $request, Carro $carro)
    {
        try {
            $this->carroService->atualizar($carro, $request->validated());
            return redirect()->route('carros.index')->with('success', 'Carro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carro $carro)
    {
        try {
            $this->carroService->excluir($carro);
            return redirect()->route('carros.index')->with('success', 'Carro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('carros.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function marcarComoVendido(int $id)
    {
        try {
            $this->carroService->marcarComoVendido($id, true);
            return redirect()->route('carros.index')->with('success', 'Carro marcado como vendido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
