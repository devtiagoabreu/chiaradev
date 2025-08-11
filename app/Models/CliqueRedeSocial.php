<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CliqueRedeSocial extends Model
{
    protected $table = 'cliques_rede_sociais';

    protected $fillable = [
        'tiktok',
        'instagram',
        'whatsapp',
    ];
}
