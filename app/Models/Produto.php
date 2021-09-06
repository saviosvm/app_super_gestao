<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    //  estou usando o hasone aqui porque essa é a tabela mais forte se comparada a ProdutoDetalhe
    public function produtoDetalhe(){ // o metodo pode ter qualquer nome
        //$this aponta para o Produto que é esse model aqui, ai depois em hasOne passa o caminho para ProdutoDetalhe
        return $this->hasOne('App\Models\ProdutoDetalhe');
        // aqui estamos dizendo que Produto tem 1 ProdutoDetalhe
        // pega um registro relacionado com produto_detalhes(fk)->produto_id
    }

    

   
}
