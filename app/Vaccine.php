<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $fillable = [
        'name',
        'information',
        'specie_id'
    ];

    public function specie()
    {
        return $this->belongsTo(Specie::class);
    }
}
