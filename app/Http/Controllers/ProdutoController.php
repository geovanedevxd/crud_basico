<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'custo' => 'required|numeric',
        'preco' => 'required|numeric',
        'quantidade' => 'required|integer',
    ]);

    Produto::create([
        'nome' => $request->input('nome'),
        'custo' => $request->input('custo'),
        'preco' => $request->input('preco'),
        'quantidade' => $request->input('quantidade'),
    ]);

    return redirect('/produtos/novo')->with('success', 'Produto salvo com sucesso!');
}


    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.show', ['produto' => $produto]);
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update([
            'nome' => $request->nome,
            'custo' => $request->custo,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return "Produto Atualizado com Sucesso!";
    }

    public function delete($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.delete', ['produto' => $produto]);
    }

    public function destroy($id)
{
    $produto = Produto::findOrFail($id);
    $produto->delete();
    return redirect('/produtos')->with('success', 'Produto excluído com sucesso!');
}

}
