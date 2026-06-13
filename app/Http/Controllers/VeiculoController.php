<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usamos eager loading (with) para evitar o problema de consultas N+1
        $veiculos = Veiculo::with('cliente')->latest()->paginate(10);
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('veiculos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'placa' => 'required|string|max:10|unique:veiculos,placa',
            'cor' => 'nullable|string|max:30',
            'ano' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        Veiculo::create($dadosValidados);
        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
         $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'placa' => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'cor' => 'nullable|string|max:30',
            'ano' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $veiculo->update($dadosValidados);
        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo removido com sucesso.');
    }
}
