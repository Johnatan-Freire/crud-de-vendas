@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Adicionar Novo Produto</h2>
        <form action="{{ route('produtos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao"></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" id="preco" required>
            </div>
            <div class="form-group">
                <label for="estoque">Estoque:</label>
                <input type="number" class="form-control" name="estoque" id="estoque" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar Produto</button>
        </form>
    </div>
@endsection
