<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Care extends Model
{
    use HasFactory;

    protected $table = 'cares';              // table associated with the model
    protected $primaryKey = 'record_id';            // primary key associated with the table

    protected $fillable = [                         // attributes that are mass assignable
        'care_date',
        'med_morn',
        'med_noon',
        'med_eve',
        'med_night',
        'breakfast',
        'lunch',
        'dinner',
        'patient_id',
        'care_id',                                  // emp_id of the caregiver
    ];

    protected $casts = [                            // attributes that should be cast
        'care_date' => 'date', // format 
        'med_morn'  => 'boolean',
        'med_noon'  => 'boolean',
        'med_eve'   => 'boolean',
        'med_night' => 'boolean',
        'breakfast' => 'boolean',
        'lunch'     => 'boolean',
        'dinner'    => 'boolean',
    ];

    
    // -- Relational Functions -- //

    public function employee(): BelongsTo
    {
        return $this->belongsTo(
            related:    Employee::class, 
            foreignKey: 'emp_id', 
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
