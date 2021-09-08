@extends('app.layouts.basico')
@section('titulo', 'clientes')
@section('conteudo')


    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.create') }}">Novo</a></li>
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

                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nome }}</td>

                                <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Vizualizar</a></td>

                                <td>
                                    <form id="form_{{ $cliente->id }}"
                                        action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit"> Excluir</button>-->
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $cliente->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a></td>

                            </tr>

                        @endforeach
                    </tbody>

                </table>


                <!-- {{ $clientes->appends($request)->links() }}-->
                Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de
                {{ $clientes->firstItem() }} a
                {{ $clientes->lastItem() }})

            </div>
        </div>
    </div>

@endsection
