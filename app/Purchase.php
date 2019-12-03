<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable=[
       "flatshare_id",
        "name",
        "count",

    ];

    public function flatshares() {
        return $this->belongsTo(Flatshare::class);
    }


    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
