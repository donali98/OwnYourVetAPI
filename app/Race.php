<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = [
        'name',
        'specie_id'
    ];

    public function species()
    {
        return $this->belongsTo(Specie::class);
    }
}
