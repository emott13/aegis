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
        'role_name',
    ];

    // Relationship: one role has many users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
