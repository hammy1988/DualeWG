<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flatshare extends Model
{
    //
    protected $fillable=[
        "name",
        "tagid",
        "admin_id",
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
