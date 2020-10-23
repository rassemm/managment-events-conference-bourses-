<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;
class EventsController extends Controller
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
        $events = Event::with('user')->paginate( 20 );
        return view('dashboard.events.eventsList', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
          'title'    => 'required|min:1|max:64',
          'content'  => 'required',
          'date'     => 'required|date_format:Y-m-d',
          'type'     => 'required'
        ]);
        $user = auth()->user();
        $event = new Event();
        $event->title     = $request->input('title');
        $event->content   = $request->input('content');
        $event->type = $request->input('type');
        $event->date = $request->input('date');
        $event->user_id = $user->id;
        $event->save();
        $request->session()->flash('message', 'Successfully created event');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $event = Event::with('user')->find($id);
        $users = User::whereHas('events', function($q) use($event){
          $q->whereIn('event_id', [$event->id]);
        })->get()->map(function ($item, $key) use($id){
          $item->status = DB::select('select * from event_user where event_id = :id and user_id= :uid', ['id' => $id,'uid' => $item->id])[0]->status;
          return $item;
        });
        return view('dashboard.events.eventShow', [ 'event' => $event , 'users' => $users ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $event = Event::find($id);
        $users = User::whereHas('events', function($q) use($event){
          $q->whereIn('event_id', [$event->id]);
        })->get()->map(function ($item, $key) use($id){
          $item->status = DB::select('select * from event_user where event_id = :id and user_id= :uid', ['id' => $id,'uid' => $item->id])[0]->status;
          return $item;
        });

        return view('dashboard.events.edit', ['event' => $event , 'users' => $users]);
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
            'date'              => 'required|date_format:Y-m-d',
            'type'              => 'required'
        ]);
        $event = Event::find($id);
        $event->title     = $request->input('title');
        $event->content   = $request->input('content');
        $event->type = $request->input('type');
        $event->date = $request->input('date');
        $event->save();
        $request->session()->flash('message', 'Successfully edited event');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $event = Event::find($id);
        if($event){
            $event->delete();
        }
        return redirect()->route('events.index');
    }
    public function subscribe($id){
      auth()->user()->events()->attach($id);
      return redirect()->back();
    }
    public function remove($id,$uid){
      User::find($uid)->events()->detach($id);
      return redirect()->back();
    }
    public function myEvents(){
        $events = Event::whereHas('user', function($q){
          $q->whereIn('user_id', [auth()->user()->id]);
        })->get()->map(function ($item, $key){
          $item->status = DB::select('select * from event_user where event_id = :id and user_id= :uid', ['id' => $item->id,'uid' => auth()->user()->id])[0]->status;
          return $item;
        });
        return view('dashboard.events.myEventsList', ['events' => $events]);
    }
    public function approve($uid,$id){
      DB::update('update event_user set status = "approved" where event_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function unapprove($uid,$id){
      DB::update('update event_user set status = "unapproved" where event_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function publish($id){
      $event = Event::find($id);
      $event->status = 'published';
      $event->save();
      return redirect()->back();
    }
    public function unpublish($id){
      $event = Event::find($id);
      $event->status = 'unpublished';
      $event->save();
      return redirect()->back();
    }
}
