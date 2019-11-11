<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD

    public function roles() {
        return $this->belongsTo(Role::class);
    }

    public function wgs() {
        return $this->belongsToMany(WG::class);
    }

    public function hasActiveWG() {
        if ($this->wgs()->exists()) {
            return true;
        }
        return false;
    }

    /*public function wgchoiceRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyWGRole($roles) || false;
        }

        return $this->hasRoles($roles) || false;
    }

    public function hasAnyWGRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasWGRole($roles) {
        return null !== $this->roles()->where('name', $roles)->first();
    }*/
=======
>>>>>>> parent of 99638b4... Zuweisungen von WG und Role erstellt
}
