<?php

namespace App\Http\Controllers;
//use View;

use DB;
use DateTime;
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

        $this->validate($request, [
            'nom_tache' => 'required|min:2|max:50',
            'description_tache' => 'required|min:2|max:200',
            'tache_date_du' => 'required|date',
            
        ],
        [
                'nom_tache.required' => 'Le nom est obligatoire.',
                'nom_tache.min' => 'Le nom doit contenir minimum 2 caracteres.',
                'nom_tache.max' => 'Le nom doit contenir max 50 caracteres.',
                'description_tache.required' => 'La description est obligatoire.',
                'description_tache.min' => 'La description doit contenir minimum 2 caracteres.',
                'description_tache.max' => 'La description doit contenir max 200 caracteres.',
                'tache_date_du.required' => 'La date est obligatoire.',
                'tache_date_du.date' => 'La date est invalide.',
        ]);



        //Log::info(Auth::user()->id);
        $tache = new Tache;      
        $tache->nom = request('nom_tache');
        $tache->date_du = request('tache_date_du');
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


        $date_now = new DateTime("now");
        $date_date_du = new DateTime(request("tache_date_du"));
 
        $data = array(
             'last_inserted_id' => $tache->id,
             'nom' => request('nom_tache'),
             'description' => request('description_tache'),
             'tache_date_du' => request('tache_date_du'),
             'tache_retard' => ($date_now > $date_date_du)
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
            ->select('tache.nom as tache_nom', 'tache.description as tache_description','tache.date_du as tache_date_du', 'users.telephone as telephone','users.name AS creer_par',  'users.email as courriel', 'tache.created_at as tache_creer_date', 'tache.updated_at as tache_maj_date')
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
            'tache_date_du' => $tache->date_du,
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

        $this->validate($request, [
            'modifier_nom_tache' => 'required|min:2|max:50',
            'modifier_description_tache' => 'required|min:2|max:200',
            'modifier_tache_date_du' => 'required|date',
            
        ],
        [
                'modifier_nom_tache.required' => 'Le nom est obligatoire.',
                'modifier_nom_tache.min' => 'Le nom doit contenir minimum 2 caracteres.',
                'modifier_nom_tache.max' => 'Le nom doit contenir max 50 caracteres.',
                'modifier_description_tache.required' => 'La description est obligatoire.',
                'modifier_description_tache.min' => 'La description doit contenir minimum 2 caracteres.',
                'modifier_description_tache.max' => 'La description doit contenir max 200 caracteres.',
                'modifier_tache_date_du.required' => 'La date est obligatoire.',
                'modifier_tache_date_du.date' => 'La date est invalide.',
        ]);

        $tache = Tache::find($id);
        $tache->nom = $request->modifier_nom_tache;
        $tache->date_du = $request->modifier_tache_date_du;
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
