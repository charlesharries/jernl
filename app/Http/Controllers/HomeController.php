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
        $now = (new \DateTime())->format('Y-m');
        return redirect("/calendar/$now");
    }

    public function month($year, $month)
    {
        $posts = auth()->user()->posts;
        $allEntries = auth()->user()->allEntryDates($year);

        $first = new \DateTime("first day of $year-$month");
        $last = new \DateTime("last day of $year-$month");
        $month = new \DatePeriod($first, (new \DateInterval('P1D')), $last->modify('+1 day'));

        $lastMonth = (new \DateTime($month->getStartDate()->format('Y-m-d')))->sub(new \DateInterval('P1M'));
        $nextMonth = (new \DateTime($month->getStartDate()->format('Y-m-d')))->add(new \DateInterval('P1M'));

        return view('calendar')->with(compact('posts', 'month', 'lastMonth', 'nextMonth', 'allEntries'));
    }
}
