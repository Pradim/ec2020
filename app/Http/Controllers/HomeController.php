<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function admin(){
        return view('admin.index');
    }

    public function seller(){
        return view('seller.index');
    }

    public function user(){
        return redirect()->route('homePage');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
//        request()->session()->flash('success', 'Welcome!');
        if (session('first')){
            session()->flash('success', 'Welcome to admin panel');
            session()->forget('first');
        }
        return redirect()->route(request()->user()->role);
    }
}
