@extends('app.layouts.basico')
@section('titulo', 'Produtos')
@section('conteudo')


    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Vizualizar produtos</p>
        </div>

        <div style="float:right; margin-right:70px; ">
            <ul style="list-style-type: none; margin: 0; padding: 0; overflow: hidden;">
                <li style="display: inline; float: left;"><a href="{{ route('produto.index') }}">voltar</a></li>
            </ul>

        </div>

        <div class="informacao-pagina">
            <div style="width: 60%; margin-left: auto; margin-right: auto;">
                <table border="1" width='100%'>
                    <!--cria a tabela e adicionei as bordas -->

                    <tr>
                        <th>ID</th>
                        <td>{{ $produto->id }}</td>
                    </tr>

                    <tr>

                        <th>Nome</th>
                        <td>{{ $produto->nome }}</td>
                    </tr>

                    <tr>

                        <th>Peso</th>
                        <td>{{ $produto->peso }}</td>
                    </tr>

                    <tr>

                        <th>Descrição</th>
                        <td>{{ $produto->descricao }}</td>
                    </tr>

                    <tr>

                        <th>Unidade de Medida</th>
                        <td>{{ $produto->unidade_id }}</td>
                    </tr>



                </table>
                <div style=" color: red;">{{$msg ?? ''}}</div> 




            </div>
        </div>
    </div>

@endsection
