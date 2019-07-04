<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day',
        'id_user'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
}
