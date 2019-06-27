<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'race_id'
    ];
    public function race(){
        return $this->belongsTo(Race::class);
    }

}
