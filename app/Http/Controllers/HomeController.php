<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Conference;
use App\Bourse;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
 	$events = Event::with('user')->paginate( 20 );
	$conferences = Conference::with('user')->paginate( 20 );
        $bourses = Bourse::with('user')->paginate( 20 );
        return view('dashboard.homepage', ['events' => $events,'conferences' => $conferences,'bourses' => $bourses]);
    }
}