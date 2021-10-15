<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Categoria;
use App\Models\Produto;

class InsertProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cat = new Categoria(['categoria' => 'geral']);
        $cat->save();

        $prod1 = new Produto(['nome' => 'Produto 1', 'valor' => 10, 'foto' => 'images/product1.png', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod1->save();

        $prod2 = new Produto(['nome' => 'Produto 2', 'valor' => 20, 'foto' => 'images/product2.png', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod2->save();

        $prod3 = new Produto(['nome' => 'Produto 3', 'valor' => 30, 'foto' => 'images/product3.png', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod3->save();

        $prod4 = new Produto(['nome' => 'Produto 4', 'valor' => 40, 'foto' => 'images/product4.png', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod4->save();

        $prod5 = new Produto(['nome' => 'Produto 5', 'valor' => 50, 'foto' => 'images/product5.png', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod5->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
