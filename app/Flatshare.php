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

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function adminCrownCounter() {
        return $this->admin->crowncnt;
    }

    public function newRandomAdmin(User $notThisOne) {

        $otherUsers = array();
        foreach($this->users as $val) {
            if ($val->id != $notThisOne->id) {
                $otherUsers[] = $val;
            }
        }

        if (count($otherUsers) >= 1) {
            $newAdmPos = rand(0, count($otherUsers) - 1);
            $this->admin_id = $otherUsers[$newAdmPos]->id;
            $this->save();
            return $otherUsers[$newAdmPos];
        } else {
            return null;
        }


    }
}
