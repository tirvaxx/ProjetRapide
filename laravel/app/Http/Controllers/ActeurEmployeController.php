<?php

namespace App\Http\Controllers;

use View;
use App\ActeurEmploye;
use Illuminate\Http\Request;

class ActeurEmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('acteurEmployes.index')->with('title', 'Les Acteurs')->with('ae',ActeurEmploye::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('acteurEmployes.create')->with('title', 'Insérer un utilisateur');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acteurEmploye = new ActeurEmploye;
        $acteurEmploye->prenom = request('prenom');
        $acteurEmploye->nom = request('nom');
        $acteurEmploye->date_embauche = request('date_embauche');
        $acteurEmploye->date_cessation_emploi  = request('date_cessation_emploi');
        $acteurEmploye->actif = request('actif');
        $acteurEmploye->save();

        $data = array(
             'last_inserted_id' => $acteurEmploye->id
        );
        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActeurEmploye  $acteurEmploye
     * @return \Illuminate\Http\Response
     */
    public function show(ActeurEmploye $acteurEmploye)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActeurEmploye  $acteurEmploye
     * @return \Illuminate\Http\Response
     */
    public function edit(ActeurEmploye $acteurEmploye)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActeurEmploye  $acteurEmploye
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActeurEmploye $acteurEmploye)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActeurEmploye  $acteurEmploye
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActeurEmploye $acteurEmploye)
    {
        //
    }
}
