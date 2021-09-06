<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    use HasFactory;
    protected $table = 'produto_detalhes'; //Faz  ItemaDetalhe mapear a tabela produto_detalhes;
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    function Item(){
        return $this->belongsTo('App\Models\Item', 'produto_id', 'id' ); // produto_id é a fk de produto_detalhes, este que é mapeado em Item.
                                                                        // id é a pk de produtos que é mapeado pelo model Item
                                                                        
    }                                                       

}
