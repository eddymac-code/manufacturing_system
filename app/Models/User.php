<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
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
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function assignRole($role)
    {
        return $this->roles()->sync($role);
    }

    public function dropRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function hasRole($name)
    {
        $roles = $this->roles;

        foreach ($roles as $role) {
            return $role->slug === str()->snake($name);
        }
        
        return false;
    }
    
    public function hasPermissionTo($name)
    {
        $roles = $this->roles;

        foreach ($roles as $role) {

            if ($role->permissions->count()) {
                foreach ($role->permissions as $permission) {
                    if ($permission->slug === str()->snake($name)) {
                        return true;
                    }   
                }
            }

            return false;
        }

        return false;
    }
}
