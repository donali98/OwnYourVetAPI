<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPatient extends Model
{
    protected $fillable = [
      'client_id',
      'patient_id'  
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
