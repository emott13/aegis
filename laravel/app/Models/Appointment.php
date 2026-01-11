<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'appt_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'appt_date',
        'patient_id',
        'doctor_id',
        'doc_comment'
    ];

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'doctor_id', 'emp_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
}
