<?php

namespace App\Http\Controllers;
use Log;
use DB;
use App\ProjetRapide;
use Illuminate\Http\Request;

class ProjetRapideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projetInit($id)
    { 


        //non complete
        //a la selection d'un projet... appeler ce controller
           $projet = DB::table('vw_sprint_activite_actif')->select("projet_id", "projet_nom", "projet_description", "projet_date_du", "projet_date_complete", "sprint_id", "sprint_numero", "sprint_date_debut", "sprint_date_fin", DB::raw("(case when datediff(sprint_date_fin, Date(now())) < 0 then 'true' else 'false' end) as sprint_retard"), "liste_id", "liste_nom", "liste_description", "tache_id", "tache_nom", "tache_description","tache_date_du",  DB::raw("(case when datediff(tache_date_du, Date(now())) < 0 then 'true' else 'false' end) as tache_retard"))
            ->where("projet_id", "=", $id)
            ->orderby("sprint_id", "asc")
            ->orderby("liste_id", "asc")
            ->orderby("tache_ordre", "asc")
            ->get();

            return  $projet;
    }

    public function index()
    {

    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjetRapide  $projetRapide
     * @return \Illuminate\Http\Response
     */
    public function show(ProjetRapide $projetRapide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjetRapide  $projetRapide
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjetRapide $projetRapide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjetRapide  $projetRapide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjetRapide $projetRapide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjetRapide  $projetRapide
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjetRapide $projetRapide)
    {
        //
    }
}
