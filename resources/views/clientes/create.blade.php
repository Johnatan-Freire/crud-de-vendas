@extends('layouts.app')
@section('container')
@section('content')
    <div class="container">
        <h2>Cadastrar Novo Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea class="form-control" name="endereco" id="endereco"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
