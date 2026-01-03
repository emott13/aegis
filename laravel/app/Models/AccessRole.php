<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRole extends Model
{
    protected $table = 'access_roles';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_name'
    ];
}
?>