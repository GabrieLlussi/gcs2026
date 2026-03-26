<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    protected $table = 'lancamentos';

protected $fillable = [
    'descricao',
    'data_lancamento',
    'valor',
    'tipo_lancamento',
    'situacao'
];
}
