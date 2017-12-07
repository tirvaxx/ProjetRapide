<?php

namespace App\Http\Controllers;

use Log;
use DB;
use App\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentaireController extends Controller
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

        $c = new Commentaire;
        $c->projet_id = $request->projet_id;
        $c->tache_id = $request->tache_id;
        $c->creer_par_acteur_id = Auth::id();
        $c->commentaire = $request->commentaire;
        $c->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($projet_id, $tache_id)
    {
           $commentaire = DB::select("
                select 
                `c`.`id`,
                `c`.`projet_id`,
                `c`.`tache_id`,
                `c`.`commentaire`,
                `c`.`date_creation`,
                c.`nom_employe`,
                c.`photo`
                from vw_commentaires c 
                where c.projet_id = ? and c.tache_id = ?
                order by c.id

            ", array($projet_id, $tache_id));
            

       return $commentaire;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
