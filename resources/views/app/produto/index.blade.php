@extends('app.layouts.basico')
@section('titulo', 'Produtos')
@section('conteudo')


    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>

        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">


                <table border="1" width='100%'>
                    <!--cria a tabela e adicionei as bordas -->

                    <thead>
                        <!--destaca a linha para dar nome a coluna -->
                        <tr>
                            <!-- linha com o nome de cada coluna -->
                            <th>Nome</th>
                            <!--cria a coluna-->
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Site</th>
                            <th>peso</th>
                            <th>Uinidade-id</th>
                            <th>Comprimento</th>
                            <th>Largura</th>
                            <th>Altura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{$produto->fornecedor->nome}}</td>
                                <td>{{$produto->fornecedor->site}}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <!-- metodo hasOne que esá no model Produto "Item" este que mapeia produtos e recebe ItemDetalhe--->
                                <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>
                                <!-- metodo hasOne que esá no model Produto "Item" este que mapeia produtos e recebe ItemDetalhe--->
                                <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                <!-- metodo hasOne que esá no model Produto "Item" este que mapeia produtos e recebe ItemDetalhe--->
                                
                                <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Vizualizar</a></td>
                                <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                                <td>
                                    <form id="form_{{ $produto->id }}"
                                        action="{{ route('produto.destroy', ['produto' => $produto->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit"> Excluir</button>-->
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $produto->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <th colspan="12">
                                    <p>Pedidos</p>
                                    @foreach ($produto->pedidos as $pedido )
                                    <a href="{{route('pedido-produto.create', ['pedido' => $pedido->id])}}">
                                      Pedido: {{$pedido->id}},
                                    </a>
                                        
                                    @endforeach
                                </th>
                            </tr>



                        @endforeach
                    </tbody>

                </table>


                <!-- {{ $produtos->appends($request)->links() }}-->
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de
                {{ $produtos->firstItem() }} a
                {{ $produtos->lastItem() }})

            </div>
        </div>
    </div>

@endsection
