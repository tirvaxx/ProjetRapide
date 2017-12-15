<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use App\Projet;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\ProjetAssignation;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
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


            return view("projetRapide")->with("dataProjet", $projet->toArray());
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
           
        $projet = new Projet;

        $projet->creer_par_acteur_id = 1;
        $projet->nom = request('nom_projet');
        $projet->description = request('description_projet');
        $projet->date_du = $request->input('date_du_projet');
        $projet->save();


        $data = array(
        );
        return $data;
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $projet = DB::select(DB::raw(" SELECT 
                    id AS projet_id,
                    nom AS projet_nom,
                    description AS projet_description,
                    date_du AS projet_date_du,
                    (
                        CASE WHEN DATEDIFF(date_du, DATE(NOW())) < 0 THEN 'true' ELSE 'false'
                        END) AS projet_retard
                FROM
                    projet p
                    inner join projet_assignation pa
                    on p.id = pa.projet_id
                WHERE
                pa.actif = 1
                and pa.acteur_id = " . Auth::user()->id ));


        //dd($projet);

        return view("projetRapide")->with("dataProjet", $projet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\id  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projet = Projet::find($id);
        $data = array(
            'projet_id' => $projet->id,
            'projet_nom' => $projet->nom,
            'projet_description' => $projet->description,
            'projet_date_du' => $projet->date_du,
            'projet_date_complete' => $projet->date_complete
       );
       return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\id  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projet = Projet::find($id);
        $projet->nom = $request->modifier_nom_projet;
        $projet->description = $request->modifier_description_projet;
        $projet->date_du = $request->input('modifier_date_du_projet');
        $projet->date_complete = $request->input('modifier_date_complete_projet');
        $projet->update();

        $data = array(
           'message' => 'Le projet a été modifié avec succès.'
       );
       return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\id  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = array(

          'message' => 'Le projet a été supprimé.'
      );
      return $data;
    }
    public function assignation(Request $request) {
        

        $projet_assignation = new ProjetAssignation;
        
        $projet_assignation->projet_id = request("projet_id");
        
        $result = Admin::where('name', $request->input("search-bar"))->value('id');
        
        //dd($result);
        //dd($request->input("search-bar"));
        $projet_assignation->acteur_id = 1;
        $projet_assignation->save();

        $data = array(
          'message' => 'Assignation réussie.'
        );

        return $data;
    }
}
