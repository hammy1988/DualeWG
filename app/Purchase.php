<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Purchase extends Model
{
    //
    protected $fillable=[
       "flatshare_id",
        "name",
        "count",

    ];

    public function flatshare() {
        return $this->belongsTo(Flatshare::class);
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
