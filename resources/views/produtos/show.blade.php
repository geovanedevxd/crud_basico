<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver um Produto</title>
</head>
<body>
    
        <label  for=""> Nome Produto</label>
        <input type="text" name="nome" value="{{$produto->nome}}"><br/>
        <label  for=""> Custo Produto</label>
        <input type="text" name="custo"value="{{$produto->custo}}"><br/>
        <label  for=""> Preço Produto</label>
        <input type="text" name="preço"value="{{$produto->preco}}"><br/>
        <label  for=""> Quantidade Produto</label>
        <input type="text" name="quantidade"value="{{$produto->quantidade}}"><br/>
        <button>Salvar</button>

    

</body>
</html>