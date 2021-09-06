@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
<!--enviando o titulo da aba-->


@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor-Adicionar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.listar') }}">Voltar</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>

        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.adicionar') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? '' }}">
                    @csrf
                    <input type="text" name="nome" value="{{ $fornecedor->nome ?? old('nome') }}" placeholder="Nome"
                        class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="site" value="{{ $fornecedor->site ?? old('site') }}" placeholder="site"
                        class="borda-preta">
                    {{ $errors->has('site') ? $errors->first('site') : '' }}

                    <input type="text" name="uf" value="{{ $fornecedor->uf ?? old('uf') }}" placeholder="Uf"
                        class="borda-preta">
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}

                    <input type="text" name="email" value="{{ $fornecedor->email ?? old('email') }}" placeholder="Email"
                        class="borda-preta">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}

                    <button class="borda-preta" type="submit"> Cadastrar</button>
                    {{ $msg ?? '' }}
                </form>
            </div>
        </div>
    </div>

@endsection
