@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adicionar Nova Venda</h1>
        <form id="vendaForm" action="{{ route('vendas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" required>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="forma_pagamento">Forma de Pagamento</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cartão">Cartão</option>
                    <option value="boleto">Boleto</option>
                </select>
            </div>
            <div id="produtosContainer" class="mb-3">
                <label>Produtos</label>
                @foreach ($produtos as $produto)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input produto-checkbox" type="checkbox" name="produto_id[]"
                            value="{{ $produto->id }}" id="produto_{{ $produto->id }}" data-preco="{{ $produto->preco }}">
                        <label class="form-check-label" for="produto_{{ $produto->id }}">
                            {{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </label>
                        <input type="number" name="quantidade[{{ $produto->id }}]" class="form-control quantidade"
                            placeholder="Quantidade" min="1" style="width: 80px; margin-left: 10px;">
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="numero_parcelas">Número de Parcelas</label>
                <select name="numero_parcelas" id="numero_parcelas" class="form-control" required>
                    <option value="1">À vista</option>
                    <option value="2">2x</option>
                    <option value="3">3x</option>
                    <option value="4">4x</option>
                </select>
            </div>

            <div id="parcelasContainer">

            </div>

            <div class="form-group">
                <label>Valor da Parcela: R$<span id="valorParcela">0,00</span></label>
            </div>
            <div class="form-group">
                <strong>Total: R$<span id="totalCompra">0,00</span></strong>
            </div>
            <button type="submit" class="btn btn-success">Salvar Venda</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.produto-checkbox');
            const quantidadeInputs = document.querySelectorAll('.quantidade');
            const totalCompraSpan = document.getElementById('totalCompra');
            const valorParcelaSpan = document.getElementById('valorParcela');
            const numeroParcelasSelect = document.getElementById('numero_parcelas');
            const parcelasContainer = document.getElementById('parcelasContainer');

            function calcularTotal() {
                let total = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        const preco = parseFloat(checkbox.getAttribute('data-preco'));
                        const quantidadeInput = document.querySelector(
                            `.quantidade[name="quantidade[${checkbox.value}]"]`);
                        const quantidade = parseInt(quantidadeInput.value);
                        total += preco * quantidade;
                    }
                });
                totalCompraSpan.textContent = total.toFixed(2);
                calcularValorParcela(total);
            }

            function calcularValorParcela(total) {
                const numeroParcelas = parseInt(numeroParcelasSelect.value);
                let valorParcela = 0;
                if (numeroParcelas > 1) {
                    valorParcela = total / numeroParcelas;
                }
                valorParcelaSpan.textContent = valorParcela.toFixed(2);
            }

            function adicionarCamposVencimentoParcelas() {
                parcelasContainer.innerHTML = '';
                const numeroParcelas = parseInt(numeroParcelasSelect.value);
                for (let i = 1; i <= numeroParcelas; i++) {
                    const label = document.createElement('label');
                    label.textContent = `Dia de vencimento da parcela ${i}: `;
                    const input = document.createElement('input');
                    input.type = 'number';
                    input.min = 1;
                    input.max = 31;
                    input.name = `dia_vencimento_parcela_${i}`;
                    input.required = true;
                    input.classList.add('form-control');
                    const divFormGroup = document.createElement('div');
                    divFormGroup.classList.add('form-group');
                    divFormGroup.appendChild(label);
                    divFormGroup.appendChild(input);
                    parcelasContainer.appendChild(divFormGroup);
                }
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    calcularTotal();
                });
            });

            quantidadeInputs.forEach(function(quantidadeInput) {
                quantidadeInput.addEventListener('input', function() {
                    if (quantidadeInput.value === '' || parseInt(quantidadeInput.value) < 1) {
                        quantidadeInput.value = '1';
                    }
                    calcularTotal();
                });
            });

            numeroParcelasSelect.addEventListener('change', function() {
                adicionarCamposVencimentoParcelas();
                calcularTotal();
            });

            adicionarCamposVencimentoParcelas();
        });
    </script>
@endsection
