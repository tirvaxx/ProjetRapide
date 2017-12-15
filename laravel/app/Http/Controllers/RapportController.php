<?php

namespace App\Http\Controllers;
use DB;
use Log;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function projets()
    {
       
       $rapport = DB::table('projet')
       ->select("id as projet_id", "nom as projet_nom", DB::Raw("substring(description,1,15) as description"), "date_du as date_due", "date_complete as date_completee" )
       ->orderby("date_complete", "asc")
       ->orderby("nom", "asc")
       ->get();

       return View("rapports/projets")->with("nomRapport", "Projets")->with("dataRapport", $rapport->toArray());



         
    }

    public function projetinfo()
    {
       $rapport = DB::table('vw_projet_info')->orderby("projet_id")->get();


       return View("rapports/projetinfo")->with("nomRapport", "Projets détaillés")->with("dataRapport", $rapport->toArray());



         
    }
    public function utilisateurs()
    {
       $rapport = DB::table('users')
       ->select("id as ID","name as Nom", "email as Courriel", "telephone as Telephone","photo", DB::raw('count(projet_assignation.acteur_id) as projet_assigne'))
        ->leftJoin("projet_assignation", "projet_assignation.acteur_id", "=", "users.id")
        ->groupBy("id","name", "email", "telephone", "photo")
       ->orderby("name")
       ->get();


       return View("rapports/utilisateurs")->with("nomRapport", "Utilisateurs")->with("dataRapport", $rapport->toArray());



         
    }



    public function index()
    {
/*       $rapport = DB::table('users')->select("id as ID","name as Nom", "email as Courriel", "telephone as Telephone", "photo")->get();


       return View("rapports")->with("nomRapport", "Utilisateur")->with("dataRapport", $rapport->toArray());
*/


         $rapport = DB::table('sprint_activite')->get();

       return View("rapports")->with("nomRapport", "Sprint Activite")->with("dataRapport", $rapport->toArray());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
