<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            $now = (new \DateTime())->format('Y-m');
            return redirect("/calendar/$now");
        }
        
        return view('index');
    }
}
