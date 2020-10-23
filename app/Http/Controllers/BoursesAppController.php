<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bourse;
use App\User;
class BoursesAppController extends Controller
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
        $bourses = Bourse::with('user')->paginate( 20 );
        return view('dashboard.bourses.boursesList', ['bourses' => $bourses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.bourses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'tel'             => 'required|min:8|max:8',
            'age'             => 'required',
            'graduation'           => 'required',
            'moyenne'         => 'required',
            'id'         => 'required'
        ]);
        $user = auth()->user();
        DB::table('bourse_user')->insert([
          'tel' => $request->input('tel'),
          'moyenne' => $request->input('moyenne'),
          'age' => $request->input('age'),
          'graduation' => $request->input('graduation'),
          'bourse_id' => $request->input('id'),
          'user_id' => $user->id
        ]);
        return redirect()->route('mybourses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $bourse = Bourse::find($id);
        $you = auth()->user();
        return view('dashboard.boursesApp.show', ['bourse' => $bourse,'you' => $you]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $bourse = Bourse::find($id);
        $users = User::whereHas('bourses', function($q) use($bourse){
          $q->whereIn('bourse_id', [$bourse->id]);
        })->get()->map(function ($item, $key) use($id){
          $item->status = DB::select('select * from bourse_user where bourse_id = :id and user_id= :uid', ['id' => $id,'uid' => $item->id])[0]->status;
          return $item;
        });

        return view('dashboard.bourses.edit', ['bourse' => $bourse , 'users' => $users]);
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
            'start_date'   => 'required|date_format:Y-m-d',
            'end_date'   => 'required|date_format:Y-m-d',
            'place'         => 'required'
        ]);
        $bourse = Bourse::find($id);
        $bourse->title     = $request->input('title');
        $bourse->content   = $request->input('content');
        $bourse->start_date = $request->input('start_date');
        $bourse->end_date = $request->input('end_date');
        $bourse->place = $request->input('place');
        $bourse->save();
        $request->session()->flash('message', 'Successfully edited bourse');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $bourse = Bourse::find($id);
        if($bourse){
            $bourse->delete();
        }
        return redirect()->route('bourses.index');
    }
    public function subscribe($id){
      auth()->user()->bourses()->attach($id);
      return redirect()->back();
    }
    public function remove($id,$uid){
      User::find($uid)->bourses()->detach($id);
      return redirect()->back();
    }
    public function mybourses(){
        $bourses = Bourse::whereHas('user', function($q){
          $q->whereIn('user_id', [auth()->user()->id]);
        })->get()->map(function ($item, $key){
          $item->status = DB::select('select * from bourse_user where bourse_id = :id and user_id= :uid', ['id' => $item->id,'uid' => auth()->user()->id])[0]->status;
          return $item;
        });
        return view('dashboard.bourses.myBoursesList', ['bourses' => $bourses]);
    }
    public function approve($uid,$id){
      DB::update('update bourse_user set status = "approved" where bourse_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function unapprove($uid,$id){
      DB::update('update bourse_user set status = "unapproved" where bourse_id = :id and user_id= :uid', ['id' => $id,'uid' => $uid]);
      return redirect()->back();
    }
    public function publish($id){
      $bourse = Bourse::find($id);
      $bourse->status = 'published';
      $bourse->save();
      return redirect()->back();
    }
    public function unpublish($id){
      $bourse = Bourse::find($id);
      $bourse->status = 'unpublished';
      $bourse->save();
      return redirect()->back();
    }
}
