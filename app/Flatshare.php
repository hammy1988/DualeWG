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
        return $this->belongsToMany(User::class, 'users','flatshare_id');
    }


    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
