<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    protected $table = 'garantia';
    protected $fillable = [
        'nome_completo',
        'cpf',
        'instagram',
        'produto_codigo',
        'data_da_compra',
        'nome_da_revendedora',
        'whatsapp',
        'aceite_termos',
        'aceite_whatsapp',
    ];
}
