<?php

namespace App\Http\Controllers;

use DateTime;
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
                'errors'  => "Erreur, valeur inattendue : le Numéro de sprint doit être entre 1 et 999.",
            ], 200);
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

        $sprint_activite = new SprintActivite;
        $sprint_activite->projet_id = $request->projet_id;
        $sprint_activite->sprint_id = $sprint->id;
        $sprint_activite->actif = 1;
        $sprint_activite->creer_par_acteur_id = Auth::id();
        $sprint_activite->assigne_acteur_id = Auth::id();
        $sprint_activite->save();



        $date_now = new DateTime("now");
        $date_date_fin = new DateTime($request->input("date_fin"));
 
        $data = array(
             'last_inserted_id' => $sprint->id,
             'numero' => request('no_sprint'),
             'sprint_retard' => ($date_now > $date_date_fin)
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
     public function edit($id)
     {
         $sprint = Sprint::find($id);
         $data = array(
              'sprint_id' => $sprint->id,
              'no_sprint' => $sprint->numero,
              'date_debut' => $sprint->date_debut,
              'date_fin' => $sprint->date_fin
         );
         return $data;
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
       try{

         /*$data = array(
              'sprint_id' => $id,
              'no_sprint' => $request->no_sprint,
              'date_debut' => $request->date_debut,
              'date_fin' => $request->date_fin,
         );*/
         $sprint = Sprint::find($id);
         $sprint->numero = $request->modifier_no_sprint;
         $sprint->date_debut = $request->sprint_modifier_date_debut;
         $sprint->date_fin = $request->sprint_modifier_date_fin;
         $data = array(
              'numero' => $request->modifier_no_sprint,
         );
         // attempt validation
         if ($sprint->validate($data))
           $sprint->update();
         else {
           return response()->json([
               'status' => 'error',
               'message' => "Les valeurs entrées ne sont pas conformes aux valeurs attentues.BACK_END"
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
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sprint $sprint)
    {
        //
    }
}
