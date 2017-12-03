<?php

namespace App\Http\Controllers;

use App\Sprint;
use App\SprintActivite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Response;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;


class SprintController extends Controller
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
        // echo "ca marche";
        //Debugbar::info($request);
        try{
          $sprint = new Sprint;
          $sprint->numero = $request->no_sprint;
          $sprint->projet_id = $request->projet_id;
          $sprint->creer_par_acteur_id = Auth::id();
          $sprint->date_debut = $request->input('date_debut');
          $sprint->date_fin = $request->input('date_fin');
          $data = array(
               'numero' => $request->no_sprint,
          );
          if($sprint->validate($data)){
            $sprint->save();
          }
          else {
            return response()->json([
                'success' => 'false',
                'errors'  => "Valeur inattendue : le Numéro de sprint doit être entre 1 et 999.",
            ], 200);
          }
        }
        catch(\Exception $e)
        {
            // TODO : faire quelque chose d'autre pour les erreurs innatendues, ça ne fonctionne pas vraiment ici je pense à tester encore
            if(isset($e->statusCode) && $e->statusCode != 200){
              return response()->json([
                  'success' => 'false',
                  'errors'  => "Valeurs innatendues." + $e->getMessage(),
              ], app('Illuminate\Http\Response')->status());
               //return response()->json('Exception ' . $e->getMessage());
             }
             else {
              if($e->success = true){
                return response()->json('Exception ' . $e->getMessage());
              }
              else{
                return response()->json([
                    'success' => 'false',
                    'errors'  => "Valeurs innatendues.",
                ], 200);
              }
            }
        }

        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = $request->projet_id;
        $sprint_activite->sprint_id = $sprint->id;
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = Auth::id();
        $sprint_activite->assigne_acteur_id = Auth::id();
        $sprint_activite->save();

        
        $data = array( 
             'last_inserted_id' => $sprint->id,
             'numero' => request('no_sprint')
        );
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function show(Sprint $sprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Sprint $sprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sprint $sprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sprint $sprint)
    {
        //
    }
}
