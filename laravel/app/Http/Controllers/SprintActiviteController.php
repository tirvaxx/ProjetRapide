<?php

namespace App\Http\Controllers;
use Log;
use DB;
use App\SprintActivite;
use Illuminate\Http\Request;

class SprintActiviteController extends Controller
{



    protected function maj_bd($projet_id, $sprint_id, $json){
LOG::info("debut  maj_bd");
//DB::connection()->enableQueryLog();
        //on récupère toutes les valeurs existantes d'un projet/sprint et on les mets inactifs
        //dans le but de les réinsérés avec le bonne ordre au moment du drag and drop
       SprintActivite::where("projet_id", "=", $projet_id)
        ->where("sprint_id","=", $sprint_id)
        ->update(["actif" => 0]);




  foreach($json as $liste => $json_tache){
  //          LOG::info("liste=" + $liste);



            

           // LOG::info("tache[0]=" +  $tache[0] );
            
           
           /* SprintActivite::where("projet_id", "=", request("projet_id"))
                ->where("sprint_id","=", request("sprint_id"))
                ->where("liste_id","=", $liste)
                ->where("actif", "=", 1)
                ->update(["ordre" => 0]);
           */
            
           
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
                        $sprint_activite->creer_par_acteur_id = 2;
                        $sprint_activite->assigne_acteur_id = 2;
                        $sprint_activite->save(); 

                        /*
                       SprintActivite::where("projet_id", "=", request("projet_id"))
                            ->where("sprint_id","=", request("sprint_id"))
                            ->where("liste_id","=", $liste)
                            ->where("tache_id", "=", $tache)
                            ->update(["ordre" => $compteur]);

                        */
                        $compteur++;
                    }
                }else{
                    $sprint_activite = new SprintActivite;
                    $sprint_activite->projet_id = $projet_id;
                    $sprint_activite->sprint_id = $sprint_id;
                    $sprint_activite->liste_id = $liste;
                    $sprint_activite->actif = 1;
                    $sprint_activite->creer_par_acteur_id = 2;
                    $sprint_activite->assigne_acteur_id = 2;
                    $sprint_activite->save(); 

                }


            }
    }


//LOG::info("*************Before insert");
        //insere nouveau
        


       
       // $json2 = json_decode(request("ordre_tache"));
       // $json = request("ordre_tache");

     // LOG::info(json_encode($json2));
        
      


//$queries = DB::getQueryLog();
//LOG::info($queries);

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
    public function destroy($projet_id, $sprint_id, $json)
    {
        
        LOG::info(request("projet = " + $projet_id));
        LOG::info(request("sprint = " + $sprint_id));
        self::maj_bd($projet_id, $sprint_id,json_decode($json));


    }
}
