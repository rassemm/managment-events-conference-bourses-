<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conferences';

    /**
     * Get the User that owns the events.
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

}
