<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Conference;
use App\User;
class ConferencesController extends Controller
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
        $conferences = Conference::with('user')->paginate( 20 );
        return view('dashboard.conferences.conferencesList', ['conferences' => $conferences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.conferences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'date'   => 'required|date_format:Y-m-d',
            'place'         => 'required'
        ]);
        $user = auth()->user();
        $conference = new Conference();
        $conference->title     = $request->input('title');
        $conference->content   = $request->input('content');
        $conference->place = $request->input('place');
        $conference->date = $request->input('date');
        $conference->user_id = $user->id;
        $conference->save();
        $request->session()->flash('message', 'Successfully created conference');
        return redirect()->route('conferences.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $conference = Conference::with('user')->find($id);
        $users = User::whereHas('conferences', function($q) use($conference){
          $q->whereIn('conference_id', [$conference->id]);
        })->get()->map(function ($item, $key) use($id){
          $item->status = DB::select('select * from conference_user where conference_id = :id and user_id= :uid', ['id' => $id,'uid' => $item->id])[0]->status;
          return $item;
        });
        return view('dashboard.conferences.conferenceShow', [ 'conference' => $conference , 'users' => $users ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $conference = Conference::find($id);
        $users = User::whereHas('conferences', function($q) use($conference){
          $q->whereIn('conference_id', [$conference->id]);
        })->get()->map(function ($item, $key) use($id){
          $item->status = DB::select('select * from conference_user where conference_id = :id and user_id= :uid', ['id' => $id,'uid' => $item->id])[0]->status;
          return $item;
        });

        return view('dashboard.conferences.edit', ['conference' => $conference , 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'date'   => 'required|date_format:Y-m-d',
            'place'         => 'required'
        ]);
        $conference = Conference::find($id);
        $conference->title     = $request->input('title');
        $conference->content   = $request->input('content');
        $conference->place = $request->input('place');
        $conference->date = $request->input('date');
        $conference->save();
        $request->session()->flash('message', 'Successfully edited conference');
        return redirect()->route('conferences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $conference = Conference::find($id);
        if($conference){
            $conference->delete();
        }
        return redirect()->route('conferences.index');
    }
    public function subscribe($id){
      auth()->user()->conferences()->attach($id);
      return redirect()->back();
    }
    public function remove($id,$uid){
      User::find($uid)->conferences()->detach($id);
      return redirect()->back();
    }
    public function myconferences(){
        $conferences = Conference::whereHas('user', function($q){
          $q->whereIn('user_id', [auth()->user()->id]);
        })->get()->map(function ($item, $key){
          $item->status = DB::select('select * from conference_user where conference_id = :id and user_id= :uid', ['id' => $item->id,'uid' => auth()->user()->id])[0]->status;
          return $item;
        });
        return view('dashboard.conferences.myConferencesList', ['conferences' => $conferences]);
    }
    public function approve($uid,$id){
      DB::update('update conference_user set status = "approved" where conference_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function unapprove($uid,$id){
      DB::update('update conference_user set status = "unapproved" where conference_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function publish($id){
      $conference = Conference::find($id);
      $conference->status = 'published';
      $conference->save();
      return redirect()->back();
    }
    public function unpublish($id){
      $conference = Conference::find($id);
      $conference->status = 'unpublished';
      $conference->save();
      return redirect()->back();
      return redirect()->back();
    }
}
