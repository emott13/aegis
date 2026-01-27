<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appt_id';              // primary key associated with the table

    protected $fillable = [                         // attributes that are mass assignable
        'appt_date',
        // 'appt_time',
        'appt_comment',
        'patient_id',
        'doctor_id',
    ];

    Protected $casts = [
        'appt_date' => 'date',
        // 'appt_time' => 'datetime:H:i',
    ];


    // -- Relational Functions -- //

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(
            related:    Employee::class, 
            foreignKey: 'doctor_id', 
            ownerKey:   'emp_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(
            related:    Patient::class, 
            foreignKey: 'patient_id', 
            ownerKey:   'patient_id');
    }
}
