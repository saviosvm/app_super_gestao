@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
<!--enviando o titulo da aba-->

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
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
                            <th>Site</th>
                            <th>Uf</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <!--conteudo da tabela-->
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <!--linha -->
                                <td>{{ $fornecedor->nome }}</td>
                                <!--celula da tabela -->
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                                <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <p>Lista de produtos</p>
                                    <table border="1" style="margin: 20px">

                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($fornecedor->produtos as $key => $produto)
                                                <!-- ja estamos dentro de um forach recuperamos o apelido apontando para o metodo do model que tem hasmany-->
                                                <tr>
                                                    <td>{{ $produto->id }}</td>
                                                    <td>{{ $produto->nome }}</td>
                                                </tr>

                                            @endforeach
                                        </tbody>

                                    </table>
                                </td>
                            </tr>


                        @endforeach
                    </tbody>

                </table>


                {{ $fornecedores->appends($request)->links() }}

            </div>
        </div>
    </div>

@endsection
