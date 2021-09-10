@if (isset($pedido->id))
    <form action="{{ route('pedido.update', ['pedido' => $pedido->id]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('pedido.store') }}" method="POST">
            @csrf
@endif


<select name="cliente_id">
    <option> Selecione um Cliente</option>
    @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id }}"
            {{ ($pedido->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : '' }}>
            {{ $cliente->nome }}</option>
        <!-- se old unidade_id receber unidade->id então selected senão imprima vazio-->
    @endforeach
</select>
{{$errors->has('cliente_id') ? $errors->first('cliente_id') : ''}}

<button class="borda-preta" type="submit"> Cadastrar</button>
</form>
