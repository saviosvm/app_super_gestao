<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;
    protected $table = 'produtos'; //Faz  Item mapear a tabela produtos;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe(){
        return $this->hasOne('App\Models\ItemDetalhe', 'produto_id', 'id'); // produto_id é a fk de produto_detalhes, este que é mapeado em ItemDetalhe
                                                                            // id é a pk de produtos que é mapeado neste model
    }

    public function fornecedor(){
        return $this->belongsTo('App\Models\Fornecedor');
    }

    public function pedidos(){
        return $this->belongsToMany('App\Models\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');
    }
}
