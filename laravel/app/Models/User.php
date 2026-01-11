<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';                                 // table associated with the model
    protected $primaryKey = 'user_id';                          // primary key associated with the table

    protected $fillable = [                                     // attributes that are mass assignable
        'fname',
        'lname',
        'dob',
        'email',
        'approved',
        'phone',
        'remember_token',
        'role_id'
    ];

    protected $hidden = [                                       // attributes that should be hidden for serialization   
        'password',
        'remember_token',
    ];

    protected $casts = [                                        // attributes that should be cast
        'password' => 'hashed',
        'approved' => 'boolean',
        'dob' => 'date'
    ];
    

    // -- Relational Functions -- //

    public function role(): BelongsTo
    {
        return $this->belongsTo(
            related:    AccessRole::class, 
            foreignKey: 'role_id', 
            ownerKey:   'role_id');
    }

    public function patient(): HasOne
    {
        return $this->hasOne(
            related:    Patient::class, 
            foreignKey: 'user_id', 
            localKey:   'user_id');
    }

    public function employee(): HasOne
    {
        return $this->hasOne(
            related:    Employee::class, 
            foreignKey: 'user_id', 
            localKey:   'user_id');
    }

    // -- Getter Functions -- //
    public function getFullNameAttribute(): string
    {
        return "{$this->fname} {$this->lname}";
    }

    public function getRoleName(): mixed
    {
        return AccessRole::where(column: 'role_id', operator: $this->role_id)->get(columns: 'role_name')[0]['role_name'];
    }

    public function getAccessLevel(): mixed
    {
        return AccessRole::where(column: 'role_id', operator: $this->role_id)->get(columns: 'access_level')[0]['access_level'];
    }
}
