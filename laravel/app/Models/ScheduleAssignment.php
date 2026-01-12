<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleAssignment extends Model
{
    use HasFactory;
    protected $table = 'schedule_assignments';
    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'shift',
        'role',
        'care_group',
        'schedule_id',
        'emp_id',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(
            related: Schedule::class, 
            foreignKey: 'schedule_id', 
            ownerKey: 'schedule_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(
            related: Employee::class, 
            foreignKey: 'emp_id', 
            ownerKey: 'emp_id');
    }
}
