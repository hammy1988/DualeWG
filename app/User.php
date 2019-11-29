<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'givenname', 'name', 'username', 'email', 'password', 'api_token',
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


    public function flatshare() {
        return $this->belongsTo(Flatshare::class);
    }

    public function hasActiveFlatshare() {
        if ($this->flatshare()->exists() && $this->flatsharejoin_at != null) {
            return true;
        }
        return false;
    }

    public function hasFlatshareRequest() {
        if ($this->flatshare()->exists() && $this->flatsharejoin_at == null) {
            return true;
        }
        return false;
    }

    public function isFlatshareAdmin() {
        if ($this->flatshare()->first()->admin_id == $this->id) {
            return true;
        }
        return false;
    }

    public function isActualUser() {
        if ($this->id == Auth::id()) {
            return true;
        }
        return false;
    }
}
