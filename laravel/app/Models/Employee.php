<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'emp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hire_date',
        'salary',
        'user_id',
    ];

    // Methods
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // convenience: $employee->full_name
    public function getFullNameAttribute()
    {
        return $this->user->full_name;
    }
}
