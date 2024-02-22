@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $cliente->nome }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $cliente->email }}"
                    required>
                </ <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $cliente->telefone }}">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea class="form-control" name="endereco" id="endereco">{{ $cliente->endereco }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
@endsection
