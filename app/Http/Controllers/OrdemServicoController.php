<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\OrdemServico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo'])->latest()->paginate(10);
        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $veiculos = Veiculo::with('cliente')->orderBy('placa')->get();

        return view('ordens.create', compact('clientes', 'veiculos'));
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'descricao' => 'required|string|min:10',
            'status' => 'required|string|in:ABERTA,EM ANDAMENTO,CONCLUÍDA,CANCELADA',
            'valor' => 'nullable|numeric|min:0',
            'data_entrega' => 'nullable|date',
        ]);

        OrdemServico::create($dadosValidados);

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço criada com sucesso.');
    }

    public function show(OrdemServico $ordem)
    {
        return view('ordens.show', compact('ordem'));
    }

    public function edit(OrdemServico $ordem)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $veiculos = Veiculo::with('cliente')->orderBy('placa')->get();

        return view('ordens.edit', compact('ordem', 'clientes', 'veiculos'));
    }

    public function update(Request $request, OrdemServico $ordem)
    {
        $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'descricao' => 'required|string|min:10',
            'status' => 'required|string|in:ABERTA,EM ANDAMENTO,CONCLUÍDA,CANCELADA',
            'valor' => 'nullable|numeric|min:0',
            'data_entrega' => 'nullable|date',
        ]);

        $ordem->update($dadosValidados);

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço atualizada com sucesso.');
    }

    public function destroy(OrdemServico $ordem)
    {
        $ordem->delete();

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço removida com sucesso.');
    }
}
