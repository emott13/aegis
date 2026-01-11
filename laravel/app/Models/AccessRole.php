<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccessRole extends Model
{
    use HasFactory;
    protected $table = 'access_roles';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_name'
    ];

    // -- Relationships -- //

    public function users (): HasMany
    {
        return $this->hasMany(
            related:    User::class, 
            foreignKey: 'role_id', 
            localKey:   'role_id'
        );
    }
}
?>