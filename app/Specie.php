<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $fillable = ['name']; 
    

    public function races()
    {
        return $this->belongsToMany(Race::class);
    }

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }
}
    