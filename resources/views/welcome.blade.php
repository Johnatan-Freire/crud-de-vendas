<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Vendas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Bem-vindo ao Sistema de Vendas</h1>
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <h3>Clientes</h3>
                <p>Gestão de clientes.</p>
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">Gerenciar Clientes</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>Produtos</h3>
                <p>Gestão de produtos.</p>
                <a href="{{ route('produtos.index') }}" class="btn btn-success">Gerenciar Produtos</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>Vendas</h3>
                <p>Registro e gestão de vendas.</p>
                <a href="{{ route('vendas.index') }}" class="btn btn-info">Gerenciar Vendas</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.10/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
