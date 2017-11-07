<?php

namespace App\Http\Controllers;

use App\Tache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $retour = Tache::get();
        return $retour->ToJson();
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

        // dd(request()->all());

        $tache = new Tache;
        $tache->nom = request('nom_tache');
        $tache->description = request('description_tache');
        $tache->save();
        // $data = [
        //     'success': true,
        //     'message': 'Your AJAX processed correctly'
        // ];

      //  return view('projetRapide');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show(Tache $tache)
    {
        //
        //return ['tache' => Tache::findOrFail($id)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit(Tache $tache)
    {
        //GET	/nerds/{id}/edit	edit	nerds.edit
        /*$tache = new Tache;
        $tache->nom = request('nom_tache');
        $tache->description = request('description_tache');
        $tache->save();*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tache $tache)
    {
        //PUT/PATCH	/nerds/{id}	update	nerds.update
        /*$tache = Tache[id];
        $tache->nom = request('nom_tache');
        $tache->description = request('description_tache');
        $tache->save();*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

            
        $tache = Tache::find(request('id'));
        $tache->delete();
        // $tache = ;

        return (String)$request->input('id');
    }
}
