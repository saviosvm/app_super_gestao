<form action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}" method="POST">
    @csrf

    <select name="produto_id">

        <option> Selecione um Produto</option>

        @foreach ($produtos as $produto)

            <option value="{{ $produto->id }}"
                {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                {{ $produto->nome }}</option>
            <!-- se old unidade_id receber unidade->id então selected senão imprima vazio-->

        @endforeach

    </select>

    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <button class="borda-preta" type="submit"> Cadastrar</button>
</form>
