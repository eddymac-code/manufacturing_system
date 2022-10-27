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
        'password',
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function hasRole($role)
    {
        return $this->role->contains('name', $role);

        # For multiple roles implementation...

        // Either

        // foreach ($role as $r) {
        //     if ($this->hasRole($r->name)) {
        //         return true;
        //     }
        // }

        // or

        // return !! $role->intersect($this->roles)->count();

        /* 
        intersect method allows us to remove any items from the $role collection
        that aren't present in it's argument ($this->role)
        */

        return false;
    }
}
