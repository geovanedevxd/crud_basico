<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Excluir Usuário</h1>
    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="name" class="form-label">Tem certeza que deseja excluir este usuário?</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
