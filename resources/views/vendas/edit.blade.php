@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Venda</h1>
        <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $cliente->id == $venda->cliente_id ? 'selected' : '' }}>
                            {{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="forma_pagamento">Forma de Pagamento</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                    <option value="dinheiro" {{ $venda->forma_pagamento == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                    <option value="cartão" {{ $venda->forma_pagamento == 'cartão' ? 'selected' : '' }}>Cartão</option>
                    <option value="boleto" {{ $venda->forma_pagamento == 'boleto' ? 'selected' : '' }}>Boleto</option>
                </select>
            </div>
            <!-- Campos para editar produtos, quantidades, etc. -->
            <button type="submit" class="btn btn-success">Atualizar Venda</button>
        </form>
    </div>
@endsection
