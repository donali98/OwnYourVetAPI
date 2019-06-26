<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $incrementing = false;
    protected $fillable =[
        'id',
        'email',
        'user_type',
        'names',
        'direction'
    ];
}
