<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getUsers(Request $request) {
        $logFile = 'laravel.log';
        Log::info($request);
        $users = User::where('name', 'like', $request->input('term') . '%')->get();


        // $users = User::all('name');
        // return Response::json($users);
        return Response::json($users);

    }
}
