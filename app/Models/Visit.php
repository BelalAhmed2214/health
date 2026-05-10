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
        'is_completed',
        'user_id',
        'patient_id'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'visit_date'   => 'datetime',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
