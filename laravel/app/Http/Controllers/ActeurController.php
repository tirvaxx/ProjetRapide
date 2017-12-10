<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

//use View;
use App\Acteur;


class ActeurController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return View::make('acteurs.index')->with('title', 'Les Acteurs')->with('acteurs',Acteur::all());
        return DB::table('acteurs')->where('nom', $nom)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return View::make('acteurs.create')->with('title', 'Insérer un acteur');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Acteur  $acteur
     * @return \Illuminate\Http\Response
     */
    public function show(Acteur $acteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acteur  $acteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Acteur $acteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acteur  $acteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acteur $acteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acteur  $acteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acteur $acteur)
    {
        //
    }
}
