<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoContato; // tive que trazer o model para o contexto
use App\Models\SiteContato;



class ContatoController extends Controller
{
    public function contato(Request $request){
        
       $motivo_contatos =  MotivoContato::all();
       
       
       //controlador envia os dados para a view
        return view('site.contato', ['titulo' => 'Contato2', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){
        //dd($request);

        //realizar a validação dos dados recebidos no request
        /*
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        $contato->save();
        */

        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',  //nomes com no min 3 caracteres e no maximo 40
            'telefone' => 'required',
            'email' => 'required|email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',

        ];

        $feedback = [

            'required' => 'O campo :attribute  deve ser preenchido',
            'email.email' => 'O :attribute não está no formato correto',

            'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome pode ter no máximo 40 caracteres',
            'nome.unique' => 'Este nome ja existe na nossa base de dados',

            'motivo_contatos_id.required' => ' O campo motivo contato precisa ser selecionado',
            'mensagem.max' => ' O campo mensagem pode ter no maximo 2000 caracteres',

        ];

        $request->validate( $regras, $feedback);

       //SiteContato::create($request->all());
       $contato = new SiteContato();
       $contato->nome = $request->input('nome');
       $contato->telefone = $request->input('telefone');
       $contato->email = $request->input('email');
       $contato->motivo_contatos_id = $request->input('motivo_contatos_id');
       $contato->mensagem = $request->input('mensagem');
       $contato->save();
        return redirect()->route('site.index');

        


    }
}
