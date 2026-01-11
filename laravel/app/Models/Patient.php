<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';                      // table associated with the model
    protected $primaryKey = 'patient_id';               // primary key associated with the table

    protected $fillable = [                             // attributes that are mass assignable
        'family_code',
        'care_group',
        'admission_date',
        // 'med_morn',
        // 'med_noon',
        // 'med_night',
        'bill_amount',
        'user_id'
    ];

    protected $casts = [                                // attributes that should be cast
        'admission_date' => 'date',
    ];

    // -- Relational Functions -- //

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class, 
            foreignKey: 'user_id', 
            ownerKey: 'user_id'
        );
    }

    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(
            related: EmergencyContact::class, 
            foreignKey: 'patient_id', 
            localKey: 'patient_id'
        );
    }

    public function cares(): HasMany
    {
        return $this->hasMany(
            related: Care::class, 
            foreignKey: 'patient_id', 
            localKey: 'patient_id'
        );
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(
            related: Appointment::class, 
            foreignKey: 'patient_id', 
            localKey: 'patient_id'
        );
    }
}
