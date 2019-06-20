<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $fillable = ['name']; 
    
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function races()
    {
        return $this->belongsToMany(Race::class);
    }
}
    