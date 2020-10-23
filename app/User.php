<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];


    public function roles(){
      return $this->belongsToMany(Role::class);
    }
    public function events(){
      return $this->belongsToMany(Event::class);
    }
    public function isSubscribedEvent($id){
      return null !== $this->events()->where('event_id', $id)->first();
    }

    public function bourses(){
      return $this->belongsToMany(Bourse::class);
    }
    public function isSubscribedBourse($id){
      return null !== $this->bourses()->where('bourse_id', $id)->first();
    }

    public function conferences(){
      return $this->belongsToMany(Conference::class);
    }
    public function isSubscribedConference($id){
      return null !== $this->conferences()->where('conference_id', $id)->first();
    }
    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles){
      if (is_array($roles)) {
          return $this->hasAnyRole($roles) ||
                 abort(401, 'This action is unauthorized.');
      }
      return $this->hasRole($roles) ||
             abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    // t7otou bech tasti akther men role m3a b3adhhom
    public function hasAnyRole($roles){
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    //t7otou bech ytasti role mta3 l user , mathan est ceque houa admin walla le
    public function hasRole($role){
      return null !== $this->roles()->where('name', $role)->first();
    }
    //hedhi bech tbadel role mta3 utilisateur
    public function assignRole($role){
        //$user->roles()->attach(Role::where('name', 'user')->first());
        $this->roles()->attach($role);
    }
}
