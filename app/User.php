<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public const USUARIO_NORMAL = "1";
    public const USUARIO_ADMIN = "0";

    public $incrementing = false;
    protected $fillable =[
        'id',
        'email',
        'user_type',
        'names',
        'direction'
    ];
}
