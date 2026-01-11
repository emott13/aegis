<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyContact extends Model
{
    protected $table = 'emergency_contacts';        // table associated with the model
    protected $primaryKey = 'contact_id';           // primary key associated with the table

    protected $fillable = [                         // attributes that are mass assignable
        'fname',
        'lname',
        'phone',
        'relation',
        'patient_id',
    ];

    // -- Relational Functions -- //
    public function patient(): BelongsTo
    {
        return $this->belongsTo(
            related:    Patient::class, 
            foreignKey: 'patient_id', 
            ownerKey:   'patient_id');
    }
}
