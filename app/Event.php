<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    /**
     * Get the User that owns the events.
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

}
