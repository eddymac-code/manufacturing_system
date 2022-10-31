<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function assignPermission($permission)
    {
        // if (is_array($permission)) {
        //     foreach ($permission as $key => $value) {
        //         $this->permissions()->sync($value);
        //     }
        // }
        return $this->permissions()->sync($permission);
    }

    public function dropPermission($permission)
    {
        return $this->permissions()->detach($permission);
    }
}
