<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemVenda;
use App\Models\Parcela;

class VendaDetalhesController extends Controller
{
    public function addItem(Request $request, $vendaId)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco' => 'required|numeric',
        ]);

        $item = new ItemVenda();
        $item->venda_id = $vendaId;
        $item->produto_id = $request->produto_id;
        $item->quantidade = $request->quantidade;
        $item->preco = $request->preco;
        $item->subtotal = $item->quantidade * $item->preco;
        $item->save();

        return redirect()->route('vendas.show', $vendaId)->with('success', 'Item adicionado com sucesso.');
    }

    public function removeItem($vendaId, $itemId)
    {
        $item = ItemVenda::where('venda_id', $vendaId)->findOrFail($itemId);
        $item->delete();

        return back()->with('suc
    cess', 'Item removido com sucesso.');
    }

    public function addParcela(Request $request, $vendaId)
    {
        $request->validate([
            'numero_parcela' => 'required|integer|min:1',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
        ]);

        $parcela = new Parcela();
        $parcela->venda_id = $vendaId;
        $parcela->numero_parcela = $request->numero_parcela;
        $parcela->valor = $request->valor;
        $parcela->data_vencimento = $request->data_vencimento;
        $parcela->paga = false;
        $parcela->save();

        return redirect()->route('vendas.show', $vendaId)->with('success', 'Parcela adicionada com sucesso.');
    }

    public function removeParcela($vendaId, $parcelaId)
    {
        $parcela = Parcela::where('venda_id', $vendaId)->findOrFail($parcelaId);
        $parcela->delete();

        return back()->with('success', 'Parcela removida com sucesso.');
    }
}
