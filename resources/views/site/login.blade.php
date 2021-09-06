@extends('site.layouts.basico')

@section('titulo', $titulo) <!--enviando o titulo da aba-->

@section('conteudoContato')


        <div class="conteudo-pagina">
            <div class="titulo-pagina">
                <h1>Login</h1>
            </div>

            <div class="informacao-pagina">

                 <!--largura de 30% -->
                <div style="width:30%; margin-left:auto; margin-right:auto;">
                    <form action="{{route('site.login')}}" method="POST" >
                        @csrf
                        <input type="text" name="usuario" value="{{old('usuario')}}" placeholder="usuario" class="borda-preta">
                            {{$errors->has('usuario') ? $errors->first('usuario') : ''}}
                        <br>
                        <input type="password" name="senha" value="{{old('senha')}}" placeholder="senha" class="borda-preta">
                             {{$errors->has('senha') ? $errors->first('senha') : ''}}
                        <br>
                        <button type="submit" class="borda-preta">Acessar</button>
                    </form>
                    {{isset($erro) && $erro != '' ? $erro : '' }}<!-- Recebe o erro que foi enviado de logincontroller gerado noo metodo autenticar repassado para a rota get do metodo index e posteriormentepara ca, -->
            </div>


            </div>  
        </div>

        <div class="rodape">
            <div class="redes-sociais">
                <h2>Redes sociais</h2>
                <img src="{{asset('img/facebook.png')}}">
                <img src="{{asset('img/linkedin.png')}}">
                <img src="{{asset('img/youtube.png')}}">
            </div>
            <div class="area-contato">
                <h2>Contato</h2>
                <span>(11) 3333-4444</span>
                <br>
                <span>supergestao@dominio.com.br</span>
            </div>
            <div class="localizacao">
                <h2>Localização</h2>
                <img src="{{asset('img/mapa.png')}}">
            </div>
        </div>
        @endsection

