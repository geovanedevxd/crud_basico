<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('produto')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('pedidos.create', compact('produtos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'produto_id' => 'required|exists:produtos,id',
        'quantidade' => 'required|integer|min:1',
    ]);

    $produto = Produto::find($request->produto_id);

    // Verifique se há estoque suficiente
    if ($produto->quantidade < $request->quantidade) {
        return redirect()->back()->withErrors(['quantidade' => 'Quantidade solicitada não disponível em estoque.']);
    }

    $precoTotal = $produto->preco * $request->quantidade;

    Pedido::create([
        'produto_id' => $request->produto_id,
        'quantidade' => $request->quantidade,
        'preco_total' => $precoTotal,
    ]);

    // Atualize a quantidade do produto
    $produto->quantidade -= $request->quantidade;
    $produto->save();

    return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
}

    


    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $produtos = Produto::all();
        return view('pedidos.edit', compact('pedido', 'produtos'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'produto_id' => 'required|exists:produtos,id',
        'quantidade' => 'required|integer|min:1',
    ]);

    $pedido = Pedido::findOrFail($id);
    $produto = Produto::find($request->produto_id);
    $precoTotal = $produto->preco * $request->quantidade;

    if ($pedido->produto_id != $request->produto_id) {
        $produtoAntigo = Produto::find($pedido->produto_id);
        $produtoAntigo->quantidade += $pedido->quantidade;
        $produtoAntigo->save();

        if ($produto->quantidade < $request->quantidade) {
            return redirect()->back()->withErrors(['quantidade' => 'Quantidade solicitada não disponível em estoque.']);
        }

        $produto->quantidade -= $request->quantidade;
        $produto->save();
    } else {
        $diferencaQuantidade = $request->quantidade - $pedido->quantidade;

        if ($produto->quantidade < $diferencaQuantidade) {
            return redirect()->back()->withErrors(['quantidade' => 'Quantidade solicitada não disponível em estoque.']);
        }

        $produto->quantidade -= $diferencaQuantidade;
        $produto->save();
    }

    $pedido->update([
        'produto_id' => $request->produto_id,
        'quantidade' => $request->quantidade,
        'preco_total' => $precoTotal,
    ]);

    return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
}



public function destroy($id)
{
    $pedido = Pedido::findOrFail($id);
    $produto = Produto::find($pedido->produto_id);

    // Devolver a quantidade de produtos ao estoque
    $produto->quantidade += $pedido->quantidade;
    $produto->save();

    $pedido->delete();

    return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
}


}
