<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index(Request $request){
        $data = [];

        $listaProdutos = Produto::all();
        $data["lista"] = $listaProdutos;

        return view("home", $data);
    }

    public function categoria($idcategoria = 0, Request $categoria){
        $data = [];

        //SELECT * FROM categorias
        $listaCategorias = Categoria::all();

        //SELECT * FROM produtos limit 4
        $queryProduto = Produto::limit(4);
        if($idcategoria != 0){
            //WHERE categoria_id = $id_categoria
            $queryProduto->where("categoria_id", $idcategoria);
        }
        $listaProdutos = $queryProduto->get();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("categoria", $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request){
        $prod = Produto::find($idProduto);

        if($prod){
            //Encontrou um produto

            //Buscar da sessao o carrinho atual
            $carrinho = session('cart', []);
            array_push($carrinho, $prod);
            session([ 'cart' => $carrinho]);
        }
        return redirect()->route("home");
    }

    public function verCarrinho(Request $request){
        $carrinho = session('cart', []);
        $data = ['cart' => $carrinho];

        return view("carrinho", $data);
    }
}
