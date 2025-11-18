<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Care extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'record_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'med_morn',
        'med_noon',
        'med_night',
        'breakfast',
        'lunch',
        'dinner',
        'care_date',
        'emp_id',
        'patient_id',
    ];
}
