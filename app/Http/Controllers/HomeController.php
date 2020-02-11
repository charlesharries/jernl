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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = auth()->user()->posts;

        $first = new \DateTime('first day of this month');
        $last = new \DateTime('last day of this month');
        $month = new \DatePeriod($first, (new \DateInterval('P1D')), $last->modify('+1 day'));

        return view('calendar')->with(compact('posts', 'month'));
    }
}
