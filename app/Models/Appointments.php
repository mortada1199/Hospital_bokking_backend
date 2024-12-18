<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    


    protected $fillable = ['patient_id','date', 'comments'];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }



}
