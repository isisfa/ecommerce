<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Services\VendaService;
use App\Models\Pedido;


class ProdutoController extends Controller
{
    public function index(Request $request){
        $data = [];

        $listaProdutos = Produto::all();
        $data["lista"] = $listaProdutos;

        return view("home", $data);
    }

    public function categoria(Request $categoria, $idcategoria = 0){
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

    public function adicionarCarrinho(Request $request, $idProduto = 0){
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

    public function excluirCarrinho($indice, Request $request){
        $carrinho = session('cart', []);
        if(isset($carrinho[$indice])){
            unset($carrinho[$indice]);
        }
        session(["cart" => $carrinho]);
        return redirect()->route('ver_carrinho');
    }

    public function finalizar(Request $request){
        $prods = session('cart', []);
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, \Auth::user());

        if($result["status"] == "ok"){
            $request->session()->forget("cart");
        }

        $request->session()->flash($result["status"], $result["message"]);
        return redirect()->route("ver_carrinho");
    }

    public function historico(Request $request){
        $data = [];

        $idusuario = \Auth::user()->id;
        $listaPedido = Pedido::where("usuario_id", $idusuario)
                                ->orderBy("datapedido", "desc")
                                ->get();
        $data["lista"] = $listaPedido;
        return view("compra/historico", $data);
    }

    public function detalhes(Request $request){
        $idpedido = $request->input('idpedido');
        echo "Detalhes do pedido: " . $idpedido;
    }
}
