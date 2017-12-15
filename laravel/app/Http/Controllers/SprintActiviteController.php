<?php

namespace App\Http\Controllers;
use Log;
use DB;
use App\SprintActivite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SprintActiviteController extends Controller
{



    protected function maj_bd($projet_id, $sprint_id, $json){

        //on récupère toutes les valeurs existantes d'un projet/sprint et on les mets inactifs
        //dans le but de les réinsérés avec le bonne ordre au moment du drag and drop
       SprintActivite::where("projet_id", "=", $projet_id)
        ->where("sprint_id","=", $sprint_id)
        ->where("actif","=",1)
        ->update(["actif" => 0]);




        foreach($json as $liste => $json_tache){


            $compteur = 1;
            foreach ($json_tache as $key => $ordre_tache) {
                if(!(is_null($ordre_tache) || empty($ordre_tache)) ){
                    foreach($ordre_tache as $key => $tache) {

                        $sprint_activite = new SprintActivite;
                        $sprint_activite->projet_id = $projet_id;
                        $sprint_activite->sprint_id = $sprint_id;
                        $sprint_activite->liste_id = $liste;
                        $sprint_activite->tache_id = $tache;
                        $sprint_activite->actif = 1;
                        $sprint_activite->ordre = $compteur;
                        $sprint_activite->creer_par_acteur_id = Auth::id();
                        $sprint_activite->assigne_acteur_id = Auth::id();
                        $sprint_activite->save(); 

                      
                        $compteur++;
                    }
                }else{
                    $sprint_activite = new SprintActivite;
                    $sprint_activite->projet_id = $projet_id;
                    $sprint_activite->sprint_id = $sprint_id;
                    $sprint_activite->liste_id = $liste;
                    $sprint_activite->actif = 1;
                    $sprint_activite->creer_par_acteur_id = Auth::id();
                    $sprint_activite->assigne_acteur_id = Auth::id();
                    $sprint_activite->save(); 

                }

            }
        }

    }



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
            LOG::info(request("liste_tache"));
            $json = json_decode(request("liste_tache"));
            self::maj_bd(request("projet_id"), request("sprint_id"), $json);
        
            LOG::info("fin store");
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
    public function destroy()
    {
        
       //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SprintActivite  $sprintActivite
     * @return \Illuminate\Http\Response
     */
    public function rendreInactif(Request $request)
    {
        
        //LOG::info("projet = " + $request->projet_id);
        //LOG::info("sprint = " +  $request->sprint_id);
        //LOG::info("json = " + $request->json);
        self::maj_bd($request->projet_id, $request->sprint_id,json_decode($request->json));


    }
}
