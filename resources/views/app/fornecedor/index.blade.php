@extends('app.layouts.basico')

@section('titulo', 'Fornecedor') <!--enviando o titulo da aba-->

    @section('conteudo')
    
        <div class="conteudo-pagina">
            <div class="titulo-pagina-2">
                <p>Fornecedor</p>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></li>
                    <li><a href="">Consulta</a></li>
                </ul>

            </div>

            <div class="informacao-pagina">
                <div style="width: 30%; margin-left: auto; margin-right: auto;">
                              <form action="{{route('app.fornecedor.listar')}}" method="POST">
                                @csrf
                                  <input type="text" name="nome" placeholder="Nome" class="borda-preta">
                                  <input type="text" name="site" placeholder="site" class="borda-preta">
                                  <input type="text" name="uf" placeholder="Uf" class="borda-preta">
                                  <input type="text" name="email" placeholder="Email" class="borda-preta">
                                  <button class="borda-preta" type="submit"> Pesquisar</button>
                              </form>
                              {{$msg ?? ''}}
                </div>
            </div>
        </div>

    @endsection
