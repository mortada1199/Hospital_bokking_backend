<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'doctor',
        'specialization',
        'date',
        'email',
        'phone',
        'patientName',
        'address',
        'status',
        'BeginOfPreview',
        'endOfPreview'
    ];


    public function appointment()
    {
        return $this->hasMany(Appointments::class);
    }

}
