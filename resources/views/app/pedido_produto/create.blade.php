@extends('app.layouts.basico')

@section('titulo', 'Pedido-Produto')
<!--enviando o titulo da aba-->

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>

        </div>

        <div class="informacao-pagina">
            <h4>Detalhe do Pedido</h4>
            <p>ID do pedido: {{ $pedido->id }}</p><br>
            <p>Cliente: {{ $pedido->cliente_id }}</p>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4>Itens do pedido</h4>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do produto</th>
                            <th>Quantidade</th>
                            <th>Data do Pedido</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pedido->produtos as $produto)

                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->pivot->quantidade}}</td>
                                <td>{{$produto->pivot->created_at->format('d/m/y H:i')}}</td>

                                <td>
                                    <form id="form_{{$pedido->id}}_{{$produto->id}}" method="POST" action="{{route('pedido-produto.destroy', ['pedido' => $pedido->id, 'produto' => $produto->id])}}">
                                        @method('DELETE')
                                     @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$pedido->id}}_{{$produto->id}}').submit()">Excluir</a>
                                </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])

                @endcomponent


            </div>
        </div>
    </div>

@endsection
