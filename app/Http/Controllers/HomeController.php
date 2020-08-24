<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function month($year, $month, Request $request)
    {

        $encryptedUserKey = auth()->user()->encrypted_user_key;
        $passwordKey = $request->cookie('password_key');
        if (!$passwordKey) return Auth::logout();

        $encrypter = new \Illuminate\Encryption\Encrypter(
            $passwordKey, \Config::get('app.cipher')
        );

        $userKey = $encrypter->decrypt($encryptedUserKey);
        $dataEncrypter = new \Illuminate\Encryption\Encrypter(
            $userKey, \Config::get('app.cipher')
        );

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
