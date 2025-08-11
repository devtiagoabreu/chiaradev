<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revendedor extends Model
{
    protected $table = 'revendedor';
    
    protected $fillable = [
        'nome_completo',
        'cpf',
        'cidade_estado',
        'whatsapp',
        'instagram',
        'tipo_vendedor',
        'status',
    ];
}
