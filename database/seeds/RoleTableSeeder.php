<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
  public function run()
  {
    $role_admin = new Role();
    $role_admin->name = 'admin';
    $role_admin->description = 'Admin';
    $role_admin->save();

    $role_manager_event = new Role();
    $role_manager_event->name = 'event_manager';
    $role_manager_event->description = 'Event Manager';
    $role_manager_event->save();

    $role_manager_bourse = new Role();
    $role_manager_bourse->name = 'bourse_manager';
    $role_manager_bourse->description = 'Bourse Manager';
    $role_manager_bourse->save();

    $role_manager_conference = new Role();
    $role_manager_conference->name = 'conference_manager';
    $role_manager_conference->description = 'Conference Manager';
    $role_manager_conference->save();

    $role_user = new Role();
    $role_user->name = 'user';
    $role_user->description = 'A User';
    $role_user->save();
  }
}
