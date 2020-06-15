<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Application;


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
        // $sess_user = auth()->user();
        // dd($sess_user);
        // dd(session('usertype'));
        // Get the current usertype
        $usertype = session('usertype');
        if($usertype == 'employee') {
             // get all applied application where status review
            //  $application =  Application::where('user_id', Auth::user()->id)->get();
            return redirect()->route('registration.requests');

        } else {
            // get the applied application
            $application =  Application::where('user_id', Auth::user()->id)->get();
            return view('my-company', compact('application'));
        }
    }
}
