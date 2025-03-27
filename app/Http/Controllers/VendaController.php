<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendaRequest;
use App\Services\VendaService;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function __construct(protected VendaService $vendaService) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = $this->vendaService->listar();
        return view('vendas.index', compact('vendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carros = $this->vendaService->carrosDisponiveis();
        return view('vendas.create', compact('carros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendaRequest $request)
    {
        try {
            $this->vendaService->registrar($request->validated());
            return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->vendaService->excluir($id);
            return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
