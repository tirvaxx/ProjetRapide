<?php

namespace App\Http\Controllers;

use App\Liste;
use Illuminate\Http\Request;

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
        $liste = new Liste;    
        $liste->nom = request('nom_liste');
        $liste->description = request('description_liste');
        $liste->creer_par_acteur_id = 2;
        $liste->save();
        
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
    public function edit(Liste $liste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liste $liste)
    {
        //
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
