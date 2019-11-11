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
        $this->belongsToMany(User::class);
    }
}
