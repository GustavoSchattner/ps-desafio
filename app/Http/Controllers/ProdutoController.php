<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProdutoController extends Controller
{
    private $produtos;
    private $categorias;

    public function __construct(Produto $produtos, Categoria $categorias)
    {
        $this->produtos = $produtos;
        $this->categorias = $categorias;
    }


    public function index()
    {
        $produtos = $this->produtos->all();
        return view('produto.index', compact('produtos'));
    }


    public function create()
    {
        $categorias = $this->categorias->all();
        return view('produto.crud', compact('categorias'));
    }


    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->descricao = $request->input('descricao');
        $produto->quantidade = $request->input('quantidade');
        $imagem = $request->file('imagem')->store('produtos', 'public');
        $produto->imagem = $imagem;
        $produto->categoria_id = $request->input('categoria_id');

        $produto->save();

        return redirect('produto');
    }


    public function show($id)
    {
        $produto = $this->produtos->find($id);
        $categoria = $this->categorias->find($produto->categoria_id);
        return json_encode([$produto, $categoria]);
    }


    public function edit($id)
    {
        $produto = $this->produtos->find($id);
        $categorias = $this->categorias->all();

        return view('produto.crud', compact('produto', 'categorias'));
    }


    public function update(Request $request, $id)
    {
        $datas = $request->all();
        $produto = $this->produtos->find($id);

        if ($request->hasFile('imagem')) {
            Storage::delete('public/', $produto->imagem);
            $datas['imagem'] = $request->file('imagem')->store('produto', 'public');
        }

        $produto->update($datas);

        return redirect('produto');
    }

    public function destroy($id)
    {
        $produto = $this->produtos->find($id);
        Storage::drive('public')->delete($produto->imagem);
        $produto->delete();

        return redirect(route('produto.index'));
    }

    //Função responsável por mandar dados pra a view produtos
    public function view(Request $request)
    {
        //Pego todos os produtos e retorno eles pra view ordanados alfabeticamente
        $produtos = Produto::join('categorias', 'categorias.id', '=', 'produtos.categoria_id')
            ->orderBy('produtos.nome', 'asc');

        //Pego a categoria_id e o nome vindo da request
        $categoria_id = $request->categoria_id;
        $nome = $request->nome;

        //Verifico se o categoria_id está presente nas categorias cadastradas
        if ($categoria_id) {
            //Caso esteja os produtos serão apenas os que estão nessa categoria
            $produtos->where('categorias.id', $categoria_id);
        }
        //Verifico se nome está entre os nomes de produtos cadastrados
        if ($nome) {
            //Se sim, os produtos se tornam apenas os produtos com esse nome. OBS: o %% faz que pegue qualquer produto que possua todos esses caracteres
            $produtos->where('nome', 'like', "%$request->nome%");
        }


        $produtos = $produtos->get();
        //Torno as categorias uma lista ordenada alfabeticamente
        $categorias = Categoria::orderBy('categoria')->get();
        //retorno pra view
        return view('produtos', compact('produtos', 'categorias', 'nome', 'categoria_id'));
    }
}
