<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class whatsapp extends Model
{
    protected $table = 'whatsapp';
    protected $fillable = [
        'whatsapp',
        'mensagem_garantia',
        'mensagem_loja',
        'instagram',
        'tiktok'
    ];
}
