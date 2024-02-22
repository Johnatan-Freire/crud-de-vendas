<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendaDetalhesController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clientes', ClienteController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('vendas', VendaController::class);

Route::post('/vendas/remove-produto/{produtoId}', [VendaController::class, 'removeProduto'])->name('vendas.removeProduto');
Route::post('/vendas/add-produto', [VendaController::class, 'addProduto'])->name('vendas.addProduto');
Route::post('/vendas/calcular-parcelas', [VendaController::class, 'calcularParcelas'])->name('vendas.calcularParcelas');
//Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
Route::post('/vendas/{venda}/itens', [VendaDetalhesController::class, 'addItem'])->name('vendas.addItem');
Route::delete('/vendas/{venda}/itens/{item}', [VendaDetalhesController::class, 'removeItem'])->name('vendas.removeItem');
Route::post('/vendas/{venda}/parcelas', [VendaDetalhesController::class, 'addParcela'])->name('vendas.addParcela');
Route::delete('/vendas/{venda}/parcelas/{parcela}', [VendaDetalhesController::class, 'removeParcela'])->name('vendas.removeParcela');

