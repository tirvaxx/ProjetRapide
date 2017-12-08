<?php

namespace App\Http\Controllers;
//use View;

use DB;
use Log;
use App\Tache;
use App\SprintActivite;
use Illuminate\Http\Request;
use Auth;
//use App\Http\Controllers\Controller;
//use App\Http\Requests;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo 'ca marche ';
        //return Tache::get();
        // return response()->json(['response' => 'This is get method']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info(Auth::user()->id);
        $tache = new Tache;      
        $tache->nom = request('nom_tache');
        $tache->description = request('description_tache');
        $tache->creer_par_acteur_id = Auth::id();
        $tache->save();



        $max_ordre = SprintActivite::where("projet_id", "=", request("projet_id"))
        ->where("sprint_id","=", request("sprint_id"))
        ->Where("liste_id", "=", request("liste_id"))
        ->Where("actif", "=", 1)
        ->max(DB::raw('coalesce(ordre,0)'));
      
      

        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = request("projet_id");
        $sprint_activite->sprint_id = request("sprint_id");
        $sprint_activite->liste_id = request("liste_id");
        $sprint_activite->tache_id = $tache->id;
        $sprint_activite->ordre = $max_ordre + 1;
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = Auth::user()->id;
        $sprint_activite->assigne_acteur_id = Auth::user()->id;
        $sprint_activite->save();



        //on met inactif l'enregistrement où il n'y a pas de tache dans la liste
        SprintActivite::where("projet_id", "=", request("projet_id"))
        ->where("sprint_id","=", request("sprint_id"))
        ->Where("liste_id", "=", request("liste_id"))
        ->WhereNull("tache_id")
        ->update(["actif" => 0]);

  
        $data = array(
             'last_inserted_id' => $tache->id,
             'nom' => request('nom_tache'),
             'description' => request('description_tache')
     );


        return $data;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

        $tache = DB::table('tache')
            ->join('users', 'users.id', '=', 'tache.creer_par_acteur_id')
            ->select('tache.nom as tache_nom', 'tache.description as tache_description', 'users.name AS creer_par',  'users.email as courriel', 'tache.created_at as tache_creer_date', 'tache.updated_at as tache_maj_date')
            ->where('tache.id', '=', $id)
            ->get();
            

       return $tache;


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tache = Tache::find($id);
        $data = array(
            'tache_id' => $tache->id,
            'tache_nom' => $tache->nom,
            'tache_description' => $tache->description
       );
       return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tache = Tache::find($id);
        $tache->nom = $request->modifier_nom_tache;
        $tache->description = $request->modifier_description_tache;
        $tache->update();


        $data = array(
           'message' => 'La tâche a été modifié avec succès.'
       );
       return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        //$tache = Tache::find($id);
        //$tache->delete();


        //SprintActivite::Store($json);

        $data = array(

            'message' => 'La tâche a été supprimé.'
        );
        return $data;
    }
}
