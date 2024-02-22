@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Vendas Realizadas</h1>
        <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Adicionar Nova Venda</a>
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('vendas.index') }}" method="GET">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <input type="text" class="form-control mb-2" id="filtro_cliente" name="filtro_cliente"
                                placeholder="Nome do Cliente">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Data da Venda</th>
                    <th>Forma de Pagamento</th>
                    <th>Total</th>
                    <th>Parcelas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->cliente->nome }}</td>
                        <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($venda->forma_pagamento) }}</td>
                        <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                        <td>{{ $venda->parcelas->count() }}</td>
                        <td>
                            <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-secondary btn-sm">Editar</a>
                            <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
