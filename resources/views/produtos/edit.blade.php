@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Produto</h2>
        <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $produto->nome }}" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao">{{ $produto->descricao }}</textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" id="preco" value="{{ $produto->preco }}"
                    required>
            </div>
            <div class="form-group">
                <label for="estoque">Estoque:</label>
                <input type="number" class="form-control" name="estoque" id="estoque" value="{{ $produto->estoque }}"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Atualizar Produto</button>
        </form>
    </div>
@endsection
