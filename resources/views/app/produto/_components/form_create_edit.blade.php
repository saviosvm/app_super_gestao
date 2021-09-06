@if (isset($produto->id))
    <form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('produto.store') }}" method="POST">
            @csrf
@endif

<select name="fornecedor_id">
    <option> Selecione um Fornecedor</option>
    @foreach ($fornecedores as $fornecedor)
        <option value="{{ $fornecedor->id }}"
            {{ ($produto->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>
            {{ $fornecedor->nome }}</option>
        <!-- se old unidade_id receber unidade->id então selected senão imprima vazio-->
    @endforeach
</select>
{{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}


<input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
{{ $errors->has('nome') ? $errors->first('nome') : '' }}

<input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta">
{{ $errors->has('peso') ? $errors->first('peso') : '' }}

<select name="unidade_id">
    <option> Selecione a unidade de medida</option>
    @foreach ($unidades as $unidade)
        <option value="{{ $unidade->id }}"
            {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
            {{ $unidade->descricao }}</option>
        <!-- se old unidade_id receber unidade->id então selected senão imprima vazio-->
    @endforeach
</select>
{{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

<textarea name="descricao" cols="30"
    rows="10">{{ $produto->descricao ?? (old('descricao') ?? 'Descrição') }}</textarea>
{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

<button class="borda-preta" type="submit"> Cadastrar</button>
</form>
