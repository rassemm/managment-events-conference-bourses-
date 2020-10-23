<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $you = auth()->user();
        $users = User::all();
        $admins = User::whereHas('roles', function($q){
          $q->whereIn('name', ['admin']);
        })->get();
        $event_managers = User::whereHas('roles', function($q){
          $q->whereIn('name', ['event_manager']);
        })->get();
        $bourse_managers = User::whereHas('roles', function($q){
          $q->whereIn('name', ['bourse_manager']);
        })->get();
        $conference_managers = User::whereHas('roles', function($q){
          $q->whereIn('name', ['conference_manager']);
        })->get();
        return view('dashboard.admin.usersList',compact('users', 'admins', 'event_managers', 'bourse_managers','conference_managers', 'you'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userShow', compact( 'user' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('events')->find($id);
        $you = auth()->user();
        return view('dashboard.admin.userEditForm', compact('user','you'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256'
        ]);
        $user = User::find($id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->save();
        switch ($request->input('role')) {
          case 'event_manager':
            $user->roles()->detach(Role::all());
            $user->roles()->attach(Role::where('name', 'user')->first());
            $user->roles()->attach(Role::where('name', 'event_manager')->first());
            break;
          case 'bourse_manager':
            $user->roles()->detach(Role::all());
            $user->roles()->attach(Role::where('name', 'user')->first());
            $user->roles()->attach(Role::where('name', 'bourse_manager')->first());
            break;
          case 'conference_manager':
            $user->roles()->detach(Role::all());
            $user->roles()->attach(Role::where('name', 'user')->first());
            $user->roles()->attach(Role::where('name', 'conference_manager')->first());
            break;
          case 'admin':
              $user->roles()->attach(Role::where('name', 'admin')->first());
              $user->roles()->attach(Role::where('name', 'event_manager')->first());
              $user->roles()->attach(Role::where('name', 'bourse_manager')->first());
              $user->roles()->attach(Role::where('name', 'conference_manager')->first());
              break;
          case 'user':
            $user->roles()->detach(Role::all());
            $user->roles()->attach(Role::where('name', 'user')->first());
            break;
          default:
            break;
        }
        $request->session()->flash('message', 'Successfully updated user');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return redirect()->route('users.index');
    }
}
