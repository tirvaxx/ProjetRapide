<?php

namespace App\Http\Controllers;
//use View;
use App\Tache;
use App\SprintActivite;
use Illuminate\Http\Request;
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

       

        $tache = new Tache;
        $tache->nom = request('nom_tache');
        $tache->description = request('description_tache');
        $tache->creer_par_acteur_id = 2;
        $tache->save();



        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = request("projet_id");
        $sprint_activite->sprint_id = request("sprint_id");
        $sprint_activite->liste_id = request("liste_id");
        $sprint_activite->tache_id = $tache->id;
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = 2;
        $sprint_activite->assigne_acteur_id = 2;
        $sprint_activite->save();


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
    public function show(Tache $tache)
    {
          //return View::make('tache/show', array('tache' => $tache));
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
            'id_tache' => $tache->id,
            'nom_tache' => $tache->nom,
            'description_tache' => $tache->description
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
        $tache->nom = request('modifier_nom_tache');
        $tache->description = request('modifier_description_tache');
        $tache->update();
        $data = array( 
            'tache_id' => $tache->id,
            'nom' => request('modifier_nom_tache'),
            'description' => request('modifier_description_tache')
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
        $tache = Tache::find($id);
        $tache->delete();

        $data = array(
            'id' => $id,
            'message' => 'La tache a été supprimé.'
        );
        return $data;
    }
}
