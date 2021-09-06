<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes; //adicionando o softDelete

class Fornecedor extends Model
{
  use HasFactory;
  use EloquentSoftDeletes; // softDelete
  protected $table = 'fornecedores';
  protected $fillable  = ['nome', 'site', 'uf', 'email'];

  public function produtos()
  {
    return $this->hasMany('App\Models\Item', 'fornecedor_id', 'id'); // usado em 1->N
  }
}
