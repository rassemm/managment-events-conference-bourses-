<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bourse extends Model
{
    protected $table = 'bourses';

    /**
     * Get the User that owns the bourses.
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

}
