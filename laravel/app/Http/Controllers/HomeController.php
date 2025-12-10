<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
     */
    public function index()
    {
        if (Auth::check())
        {
            switch (Auth::user()->getRoleName())
            {
                case 'patient':
                    return redirect()->route('patient.home');
                case 'doctor':
                    return redirect()->route('doctor.home');
                default:
                    break;
            }
        }

        return view('home', [
            'role' => Auth::user()->getRoleName(),
        ]);
    }
}
