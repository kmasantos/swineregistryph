<?php

namespace App;

use App\Models\Collection;
use App\Models\Farm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get farms of user
     */
    public function farms()
    {
        return $this->hasMany(Farm::class);
    }

    /**
     * Get collections (registration of swines) of user
     */
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
