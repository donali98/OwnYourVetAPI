<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['name'];

    public function species()
    {
        return $this->belongsTo(Specie::class);
    }
}
