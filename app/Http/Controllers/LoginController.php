<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // trouxe o model para o contexto

class LoginController extends Controller
{
    public function index(Request $request){
        // recupera o erro que foi enviado no metodo autenticar abaixo
        //$erro = $request->get('erro');   //o metodo ->get() recupera atributos do request enviado via get ou post
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'O usuário ou a senha não existe';
        }
        if($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a pagina';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]); // envia o erro para a view login
    }

    public function autenticar(Request $request){
        //Regras de validação
        $regras = [
            'usuario' => 'required|email', // O usuário será um email
            'senha' => 'required' // por enquanto o campo só é obrigado a ser preenchido
        ];

        //mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'É necessário um email válido',
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback); //se não passar na validação(validate) for negada o validate retorna para a rota antiga, que é o próprio formulário de login
         
        //Recuperei os parâmetros do formulário
          $email = $request->get('usuario');
          $password = $request->get('senha');
          

          //iniciar o model User
          $user = new User();
          //verifica se o usuario e a senha existem no banco de dados
          $usuario = $user->where('email', '=', $email)->where('password', '=', $password)->get()->first(); // caso a senha que passarmos for a que está no banco, será retornado um array com as informações, caso a senha não estiver cadastrada no banco será retornado um array vazio
                                                                                                         //first pega a primeira collection de array
         //caso o email esteja no banco de dados,vai logar o usuario
         if(isset($usuario->email)){
            // dd($usuario); primeiro usei o dd para poder saber as variaveis que iria recuperar
            session_start(); // INICIA A SESSÃO
            $_SESSION['nome'] = $usuario->name; // RECUPERA OS DADOS ENCONTRADOS COM O DD A PARTIR DA SUPER GLOBAL SESSION,  ela perimite que os dados fiquem disponiveis ao lado do servidor, permitindo qe os dados sejam recuperados em outras paginas // caso tentar recuperar abrindo uma guia anonima usando a url não vai acessar
            $_SESSION['email'] = $usuario->email;
             
            return redirect()->route('app.home');
         }else{
             return redirect()->route('site.login',['erro' => 1]); // o redirect usa o verbo GET, portanto vai ser recuperado no metodo index acima
         }

    }

    public function sair(){
        session_destroy();// destroi a sessão para não ser possivel acessala sem fazer o login depois de sair
        return redirect()->route('site.index');
    }
}
