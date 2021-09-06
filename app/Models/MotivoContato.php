<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoContato extends Model
{
    use HasFactory;
    protected $fillable = ['motivo_contato']; // defini que esse atributo poderá ser preenchido em massa   
}
