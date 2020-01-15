<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable=[
        "flatshare_id",
        "title",
        "description",
        "start_at",
        "end_at",
        "fullday",
    ];

    public function flatshare() {
        return $this->belongsTo(Flatshare::class);
    }

}
