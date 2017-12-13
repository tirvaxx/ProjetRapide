<?php

namespace App\Http\Controllers;
use DB;
use Log;
use App\TacheAssignation;
use Illuminate\Http\Request;

class TacheAssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projet_id, $tache_id,$flag)
    {

DB::connection()->enableQueryLog();

        if($flag == 1){
            //user assigne
            $resultat = DB::table("users")
            ->select("id", "name as nom", "email as courriel", "photo")
            ->whereIn("id", function($q) use($projet_id,$tache_id){
                $q->select("assigne_acteur_id")
                   ->from("tache_assignation")
                   ->where("projet_id", "=", $projet_id)
                   ->where("tache_id", "=", $tache_id)
                   ->where("actif", "=", 1);
            })
            ->orderby("name", "asc")
            ->get();
        }else{
            //user disponible
            $resultat = DB::table("users")
            ->select("id", "name as nom", "email as courriel", "photo")
            ->whereNotIn("id", function($q) use($projet_id,$tache_id){
                $q->select("assigne_acteur_id")
                   ->from("tache_assignation")
                   ->where("projet_id", "=", $projet_id)
                   ->where("tache_id", "=", $tache_id)
                   ->where("actif", "=", 1);
            })
            ->orderby("name", "asc")
            ->get();
        }


// some queries here
$queries = DB::getQueryLog();
Log::info($queries);

        return $resultat;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        TacheAssignation::where("projet_id", "=", $request->projet_id)
        ->where("tache_id","=", $request->tache_id)
        ->where("actif","=",1)
        ->update(["actif" => 0]);


        $dataSet = [];
        if(!(isset($request->users) == "" || empty($request->users))){
            $str_users = str_replace(" ", "", $request->users);
            $users = explode(",",$str_users);

            $tache_assignation = new TacheAssignation;
            foreach ($users as $v) {
                Log::info($v);

                $dataSet = [
                    'projet_id' => $request->projet_id,
                    'tache_id' => $request->tache_id,
                    'assigne_acteur_id' => $v,
                    'actif' => 1
                ];
                DB::table('tache_assignation')->insert($dataSet);
            }
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TacheAssignation  $tacheAssignation
     * @return \Illuminate\Http\Response
     */
    public function show(TacheAssignation $tacheAssignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TacheAssignation  $tacheAssignation
     * @return \Illuminate\Http\Response
     */
    public function edit(TacheAssignation $tacheAssignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TacheAssignation  $tacheAssignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TacheAssignation $tacheAssignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TacheAssignation  $tacheAssignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TacheAssignation $tacheAssignation)
    {
        //
    }
}
