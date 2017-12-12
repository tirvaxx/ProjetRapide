<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet = DB::table('projet')->select("id as projet_id", "nom as projet_nom"
                                                    , "description as projet_description"
                                                    , "date_du as projet_date_du"
                                    ,  DB::raw("(case when datediff(date_du, Date(now())) < 0 then 'true' else 'false' end) as projet_retard"))
                ->whereNull("date_complete")
                ->orderby("id")
                ->get();


            return view("adminProjetRapide")->with("dataProjet", $projet->toArray());
    }
}
