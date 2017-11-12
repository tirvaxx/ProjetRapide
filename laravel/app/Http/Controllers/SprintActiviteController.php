<?php

namespace App\Http\Controllers;

use App\SprintActivite;
use Illuminate\Http\Request;

class SprintActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      
      
        //on récupère les valeurs existantes et on les mets inactifs
        SprintActivite::where("projet_id", "=", request("projet_id"))
        ->where("sprint_id","=", request("sprint_id"))
        ->Where(function ($query) {
                    $query->where("tache_id","=", request("tache_id"))
                    ->orWhereNull('tache_id');
                 })
        ->update(["actif" => 0]);
        //insere nouveau
       
        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = request("projet_id");
        $sprint_activite->sprint_id = request("sprint_id");
        $sprint_activite->liste_id = request("liste_id");
        $sprint_activite->tache_id = request("tache_id");
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = 2;
        $sprint_activite->assigne_acteur_id = 2;
        $sprint_activite->save();  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SprintActivite  $sprintActivite
     * @return \Illuminate\Http\Response
     */
    public function show(SprintActivite $sprintActivite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SprintActivite  $sprintActivite
     * @return \Illuminate\Http\Response
     */
    public function edit(SprintActivite $sprintActivite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SprintActivite  $sprintActivite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SprintActivite $sprintActivite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SprintActivite  $sprintActivite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SprintActivite $sprintActivite)
    {
        //
    }
}
