<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRole extends Model
{
    use HasFactory;

    protected $table = 'access_roles';
    protected $primaryKey = 'role_id';

    public $timestamps = false;

    protected $fillable = [
        'role_name' => 'admin',
        'role_name' => 'doctor',
        'role_name' => 'supervisor',
        'role_name' => 'caregiver',
        'role_name' => 'patient',
        'role_name' => 'family'
    ];

    // Relationship: one role has many users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
