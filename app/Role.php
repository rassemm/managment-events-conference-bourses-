<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    /**
     * Get the User that owns the bourses.
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

}
