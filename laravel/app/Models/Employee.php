<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';                     // table associated with the model
    protected $primaryKey = 'emp_id';                   // primary key associated with the table

    protected $fillable = [                             // attributes that are mass assignable
        'hire_date',
        'salary',
        'user_id',
    ];

    protected $casts = [                                // attributes that should be cast
        'hire_date' => 'date',
    ];
    
    // -- Relational Functions -- //
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related:    User::class, 
            foreignKey: 'user_id', 
            ownerKey:   'user_id'
            );
    }

    public function cares(): HasMany
    {
        return $this->hasMany(
            related:    Care::class, 
            foreignKey: 'emp_id', 
            localKey:   'emp_id');
    }

    public function doctorAppointments(): HasMany
    {
        return $this->hasMany(
            related:    Appointment::class, 
            foreignKey: 'doctor_id', 
            localKey:   'emp_id');
    }

    public function createdSchedules(): HasMany
    {
        return $this->hasMany(
            related:    Schedule::class, 
            foreignKey: 'created_by', 
            localKey:   'emp_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(
            related:    ScheduleAssignment::class, 
            foreignKey: 'emp_id', 
            localKey:   'emp_id');
    }

    // convenience: $employee->full_name
    public function getFullNameAttribute()
    {
        return $this->user->full_name;
    }
}
