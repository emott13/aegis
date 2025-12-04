<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'schedule_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'schedule_date',
        'made_by',
        'doctor_id',
        'supervisor_id',
        'care_red',
        'care_blue',
        'care_green',
        'care_yellow',
    ];

    // Methods
    public function madeBy()
    {
        return $this->belongsTo(Employee::class, 'made_by', 'emp_id')->with('user');
    }

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'doctor_id', 'emp_id')->with('user');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id', 'emp_id')->with('user');
    }

    public function careRed()
    {
        return $this->belongsTo(Employee::class, 'care_red', 'emp_id')->with('user');
    }

    public function careBlue()
    {
        return $this->belongsTo(Employee::class, 'care_blue', 'emp_id')->with('user');
    }

    public function careGreen()
    {
        return $this->belongsTo(Employee::class, 'care_green', 'emp_id')->with('user');
    }

    public function careYellow()
    {
        return $this->belongsTo(Employee::class, 'care_yellow', 'emp_id')->with('user');
    }
}
