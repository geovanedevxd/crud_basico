<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Pedido</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Criar Novo Pedido</h1>
    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select name="produto_id" class="form-control" id="produto_id">
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" data-quantidade="{{ $produto->quantidade }}">{{ $produto->nome }} (Disponível: {{ $produto->quantidade }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" id="quantidade" min="1">
            <div id="quantidade-warning" class="text-danger" style="display: none;">Quantidade solicitada excede o estoque disponível.</div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('produto_id').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var quantidadeDisponivel = selectedOption.getAttribute('data-quantidade');
            document.getElementById('quantidade').setAttribute('max', quantidadeDisponivel);
        });

        document.getElementById('quantidade').addEventListener('input', function () {
            var quantidade = parseInt(this.value);
            var maxQuantidade = parseInt(this.getAttribute('max'));
            var warning = document.getElementById('quantidade-warning');
            if (quantidade > maxQuantidade) {
                warning.style.display = 'block';
            } else {
                warning.style.display = 'none';
            }
        });
    </script>
</body>
</html>
