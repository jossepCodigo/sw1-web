<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id', 'first_name', 'last_name', 'cell_phone', 'photo_perfil'];
}
