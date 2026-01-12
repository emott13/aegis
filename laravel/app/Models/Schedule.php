<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'schedule_id';          // primary key associated with the table

    protected $fillable = [                         // attributes that are mass assignable
        'schedule_date',
        'created_by',
    ];

    protected $casts = [                            // attributes that should be cast
        'schedule_date' => 'date',
    ];

    
    // -- Relational Functions -- //

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class, 
            foreignKey: 'created_by', 
            ownerKey: 'user_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(
            related: ScheduleAssignment::class, 
            foreignKey: 'schedule_id', 
            localKey: 'schedule_id');
    }
}
