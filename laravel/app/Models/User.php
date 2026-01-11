<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AccessRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'dob',
        'email',
        'approved',
        'phone',
        'remember_token',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    // relational functions
    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id', 'user_id');
    }
    public function accessRoles()
    {
        return $this->hasOne(AccessRole::class, 'role_id', 'role_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }
    // getter functions
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    public function getRoleName()
    {
        return AccessRole::where('role_id', $this->role_id)->get('role_name')[0]['role_name'];
    }

    public function getAccessLevel()
    {
        return AccessRole::where('role_id', $this->role_id)->get('access_level')[0]['access_level'];
    }
}
