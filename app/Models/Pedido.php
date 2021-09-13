<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos()
    {
        //return $this->belongsToMany('App\Models\Produto', 'edidos_produtos'); // faz a mesma coisa que o de baixo, porem por não usar o proprio model Produto não se faz necessário passar as fk, só se passa a tabela auxiliar.
        return $this->belongsToMany('App\Models\Item', 'pedidos_produtos', 'pedido_id', 'produto_id');
        /*
            1 - Modelo(Model) do relacionemto N-N em relação ao modelo que estamos implementando.
            2 -  É a tabela auxiliar(pedidos_produtos) que armazena as FK e garante o relacionamento de NxN.
            3 - Representa a FK(pedido_id) da tabela mapeada pelo modelo(tabela pedidos desse model aqui).
            4 - Representa a FK(produto_id) que esta na tabela produtos que é mapeado pelo model Item.

        */
    }
}
