<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Unidade;
use App\Models\ProdutoDetalhe;
use App\Models\Item;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $produtos = Produto::paginate(10);
        $produtos = Item::with(['itemDetalhe', 'fornecedor', 'pedidos'])->paginate(10); // item mapeia produtos no model
        // with habilita carregamento rapido nos metodos do model Item

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();



        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id', //tabela e coluna  de onde veio a chhave estrangeira
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve receber numeros inteiros',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe',

        ];

        $request->validate($regras,  $feedback);

        Item::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $msg = $request->msg;
        $produto = Produto::find($id);

        return view('app.produto.show', ['produto' => $produto, 'msg' => $msg]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // COLOCAR NO CADERNO
        $unidades = Unidade::all();
        $produto = Produto::find($id);
        $fornecedores = Fornecedor::all();
        //return view('app.produto.edit',['produto' => $produto, 'unidades' => $unidades]);
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
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
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id', //tabela e coluna  de onde veio a chhave estrangeira
            'fornecedor_id' => 'exists:fornecedores,id', //tabela e coluna  de onde veio a chhave estrangeira

        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve receber numeros inteiros',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe',

        ];

        $request->validate($regras,  $feedback);

        //COLOCAR NO CADERNO
        $msg = '';
        $produto = Item::find($id);
        $produto->update($request->all());

        if ($produto) {
            $msg = 'Edição realizada com sucesso';
        }

        return redirect()->route('produto.show', ['produto' => $produto->id, 'msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::find($id)->delete();


        return redirect()->route('produto.index');
    }
}
