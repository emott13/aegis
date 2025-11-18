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
}
