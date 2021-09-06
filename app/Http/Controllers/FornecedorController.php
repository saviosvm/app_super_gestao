<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {

        $msg = $request->msg;

        return view('app.fornecedor.index', ['msg' => $msg]);
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like',  '%' . $request->input('nome') . '%')
            ->where('site', 'like',  '%' . $request->input('site') . '%')
            ->where('uf', 'like',  '%' . $request->input('uf') . '%')
            ->where('email', 'like',  '%' . $request->input('email') . '%')
            ->paginate(2);

        return  view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {

        $msg = '';

        if ($request->input('_token') != '' && $request->id == '') { //inclusão
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'required|email',
            ];

            $feedback = [
                'required' => 'O campo :attribute é obrigatório',

                'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',

                'uf.min' => 'O campo uf deve ter no minimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no maximo 2 caracteres',

                'email.email' => 'O campo Email não está no formato correto',
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());
            /*
           $fornecedor->create([
               'nome' => $request->input('nome'),
               'site' => $request->input('site'),
               'uf' => $request->input('uf'),
               'email' => $request->input('email'),
           ]);

          */

            $msg = "Fornecedor $request->nome Cadastrado com sucesso"; // foi declarada como vazia antes do if


        }

        if ($request->input('_token') != '' && $request->id != '') { //edição
            $fornecedor = Fornecedor::find($request->input('id'));
            $edicao =  $fornecedor->update($request->all());

            if ($edicao) {
                $msg = 'atualização realizado com sucesso';
            } else {
                $msg =  'Erro ao tentar atualizar o registro';
            }

            return  redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }



        return  view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    { // 
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id)
    {

        // DEVO ANOTAR NO CADERNO SEXTA
        $msg = '';
        $registro = Fornecedor::find($id); //  nome do registro
        $excluir = Fornecedor::find($id)->forceDelete();

        if ($excluir) {

            $msg = "Fornecedor $registro->nome  excluido com sucesso";
        }


        return redirect()->route('app.fornecedor', ['msg' => $msg]);
    }
}
