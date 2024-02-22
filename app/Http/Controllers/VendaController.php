<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Parcela;
use Carbon\Carbon;

class VendaController extends Controller
{

    public function index(Request $request)
    {
        $query = Venda::with(['cliente', 'itens.produto', 'parcelas']);

        if ($request->filled('filtro_cliente')) {
            $query->whereHas('cliente', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->filtro_cliente . '%');
            });
        }

        $vendas = $query->get();

        return view('vendas.index', compact('vendas'));
    }


    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'forma_pagamento' => 'required',
            'numero_parcelas' => 'required|integer|min:1',
            'produto_id.*' => 'required|exists:produtos,id',
            'quantidade.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $venda = Venda::create([
                'cliente_id' => $request->cliente_id,
                'data_venda' => Carbon::now(),
                'forma_pagamento' => $request->forma_pagamento,
                'total' => 0,
            ]);

            $totalVenda = 0;
            foreach ($request->produto_id as $index => $produtoId) {
                $produto = Produto::find($produtoId);
                $quantidade = $request->quantidade[$produtoId];
                $totalVenda += $produto->preco * $quantidade;
            }

            $venda->total = $totalVenda;
            $venda->save();

            $valorParcela = $totalVenda / $request->numero_parcelas;
            for ($i = 1; $i <= $request->numero_parcelas; $i++) {
                Parcela::create([
                    'venda_id' => $venda->id,
                    'valor' => $valorParcela,
                    'data_vencimento' => Carbon::now()->addMonths($i),
                ]);
            }

            DB::commit();
            return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Erro ao salvar a venda: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $venda = Venda::findOrFail($id);
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'forma_pagamento' => 'required|string',

        ]);

        $venda = Venda::findOrFail($id);

        $venda->update($validatedData);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso.');
    }


    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso.');
    }
}
