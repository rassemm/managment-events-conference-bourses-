<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
  public function run()
  {
    $roles = Role::all();
    $role_manager_event  = Role::where('name', 'event_manager')->first();
    $role_manager_bourse  = Role::where('name', 'bourse_manager')->first();
    $role_manager_conference  = Role::where('name', 'conference_manager')->first();
    $role_user  = Role::where('name', 'user')->first();

    $admin = new User();
    $admin->name = 'admin';
    $admin->email = 'admin@mail.com';
    $admin->password = bcrypt('admin123');
    $admin->save();
    $admin->roles()->attach($roles);


    $manager_event = new User();
    $manager_event->name = 'events manager';
    $manager_event->email = 'eventmanager@mail.com';
    $manager_event->password = bcrypt('manager123');
    $manager_event->save();
    $manager_event->roles()->attach($role_manager_event);
    $manager_event->roles()->attach($role_user);

    $manager_bourse = new User();
    $manager_bourse->name = 'bourses manager';
    $manager_bourse->email = 'boursemanager@mail.com';
    $manager_bourse->password = bcrypt('manager123');
    $manager_bourse->save();
    $manager_bourse->roles()->attach($role_manager_bourse);
    $manager_bourse->roles()->attach($role_user);

    $manager_conference = new User();
    $manager_conference->name = 'conferences manager';
    $manager_conference->email = 'conferencemanager@mail.com';
    $manager_conference->password = bcrypt('manager123');
    $manager_conference->save();
    $manager_conference->roles()->attach($role_manager_conference);
    $manager_conference->roles()->attach($role_user);

    $user = new User();
    $user->name = 'user';
    $user->email = 'user@mail.com';
    $user->password = bcrypt('user123');
    $user->save();
    $user->roles()->attach($role_user);
  }
}
