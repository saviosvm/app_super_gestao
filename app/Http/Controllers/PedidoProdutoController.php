<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();

        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {

        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'Registro não encontrado',
            'quantidade.required' => 'É necessário inserir a :attribute',
        ];

        $request->validate($regras, $feedback);
        /*
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pe
        dido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();
        */


        /* METODO MULTIPLAS INSERÇÕES
         $pedido->produtos()->attach([
             $request->get('produto_id') => ['quantidade' => $request->get('quantidae')],
             //agora era só ir inserinado mais registros, nesse caso iria inserir varios registros de uma vez só
         ]);
        */

        //MODO UNITÁRIO, APENAS UM REGISTRO POR VEZ
        $pedido->produtos()->attach(  //usando o metodo mapeia se o objeto
            // o atach permite 
            $request->get('produto_id'), // pega o produto do formulario
            ['quantidade' => $request->get('quantidade')] // grava a quantidade
        );


        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int PedidoProduto $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id, Produto $produto)
    {
        /*
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
        ])->delete();*/

        //DETACH(DELETE PELO RELACIONAMENTO
        //também seria possivel remover o relacionamento através do model Produto
       // $pedido->produtos()->detach($produto->id); // não precisa colocar pedido_id pois na tabela auxiliar ja coloca ele no contexto dentro do metodo produtos
       // remove todos os registros com o mesmo id em produto_id em pedido_id

       $pedidoProduto->delete();


       
        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
