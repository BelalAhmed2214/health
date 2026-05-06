<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'problem',
        'solution',
        'notes',
        'visit_date',
        'user_id',
        'patient_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
