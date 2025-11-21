<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'patient_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'family_code',
        'em_fname',
        'em_lname',
        'em_phone',
        'em_relation',
        'admission_date',
        'care_group',
        'med_morn',
        'med_noon',
        'med_night',
        'bill_amount',
        'user_id'
    ];
}
