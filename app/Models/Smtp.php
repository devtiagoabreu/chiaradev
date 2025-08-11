<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    protected $table = 'smtp';

        protected $fillable = [
            'host',
            'port',
            'encryption',
            'username',
            'password',
            'from_address',
        ];
}
