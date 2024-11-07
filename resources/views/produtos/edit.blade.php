<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar um Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <form action="{{ route('alterar_produto', ['id' => $produto->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Produto</label>
            <input type="text" name="nome" class="form-control" id="nome" value="{{ $produto->nome }}">
        </div>
        <div class="mb-3">
            <label for="custo" class="form-label">Custo Produto</label>
            <input type="text" name="custo" class="form-control" id="custo" value="{{ $produto->custo }}">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço Produto</label>
            <input type="text" name="preco" class="form-control" id="preco" value="{{ $produto->preco }}">
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade Produto</label>
            <input type="text" name="quantidade" class="form-control" id="quantidade" value="{{ $produto->quantidade }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <!-- Bootstrap JS Bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
