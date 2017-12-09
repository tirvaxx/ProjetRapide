<?php

namespace App\Http\Controllers;

use App\SprintActivite;
use App\Liste;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class ListeController extends Controller
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

      try{
          $liste = new Liste;
          $liste->nom = request('nom_liste');
          $liste->description = request('description_liste');
          $liste->creer_par_acteur_id = Auth::id();

          $data = array(
               'nom' => $request->nom_liste,
               'description' => $request->description_liste
          );

          if ($liste->validate($data))
            $liste->save();
            else {
              return response()->json([
              	'status' => 'error',
              	'message' => "Les valeurs entrées ne sont pas conformes aux valeurs attentues ou dépassent les limites permises.<br/>Nom (2 à 50 caractères)<br/>Description (2 à 200 caractères)"
              ]);
            }
        }
        catch(\Exception $e)
        {
          echo $e->getMessage();
            //return new JsonResponse($errors, 400);
            return response()->json([
            	'status' => 'error',
            	'message' => "Une erreur de serveur est survenue"
            ]);
        }
        //on met inactif l'enregistrement où il n'y a pas de liste dans le sprint
        SprintActivite::where("projet_id", "=", request("projet_id"))
        ->where("sprint_id","=", request("sprint_id"))
        ->WhereNull("liste_id")
        ->update(["actif" => 0]);


        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = request("projet_id");
        $sprint_activite->sprint_id = request("sprint_id");
        $sprint_activite->liste_id = $liste->id;
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = Auth::id();
        $sprint_activite->assigne_acteur_id = Auth::id();
        $sprint_activite->save();

        $data = array(
             'last_inserted_id' => $liste->id,
             'nom' => request('nom_liste'),
             'description' => request('description_liste')
        );
        return $data;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function show(Liste $liste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $liste = Liste::find($id);
        $data = array(
             'liste_id' => $liste->id,
             'nom_liste' => $liste->nom,
             'description_liste' => $liste->description
        );
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try{

        $data = array(
             'liste_id' => $id,
             'nom' => $request->modifier_nom_liste,
             'description' => $request->modifier_description_liste
        );
        $liste = Liste::find($id);
        $liste->nom = htmlspecialchars($request->modifier_nom_liste);
        $liste->description = htmlspecialchars($request->modifier_description_liste);
        // attempt validation
        if ($liste->validate($data))
          $liste->update();
        else {
          return response()->json([
            	'status' => 'error',
            	'message' => "Les valeurs entrées ne sont pas conformes aux valeurs attentues ou dépassent les limites permises.<br/>Nom (2 à 50 caractères)<br/>Description (2 à 200 caractères)"
            ]);
        }
      }
      catch(\Exception $e)
      {
          //return new JsonResponse($errors, 400);
        return response()->json([
          	'status' => 'error',
          	'message' => "Une erreur de serveur est survenue"
          ]);
      }
      return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liste $liste)
    {
        //
    }
}
