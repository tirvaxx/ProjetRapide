
 @extends('layouts.app')

@section('content')




        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="http://localhost:8000">Projet Rapide</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="caret"></span></a>
                  <ul id="creer_item" class="dropdown-menu">
                    <li><a id="creer_item_projet" href="#">Projet</a></li>
                    <li><a id="creer_item_sprint" href="#">Sprint</a></li>
                    <li><a id="creer_item_liste" href="#">Liste</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-right">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Rechercher">
                </div>
                <button type="button" class="btn btn-default">Rechercher</button>
              </form>
            </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

<hr />







@if(isset($dataProjet))
    <div id="projet_wrapper">
        <fieldset id="fieldset_projet">
            <legend>Projets actifs</legend>
            <div class="panel-group" id="accordion">
            @foreach ( $dataProjet as $value)
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$value->projet_id}}">
                        {{ $value->projet_nom }}</a>
                      </h4>
                    </div>
                    <div id="collapse_{{$value->projet_id}}" class="panel-collapse collapse">
                        <div class="panel-body">{{$value->projet_description}}</div>
                        <button id="btn_projet_charger" projet_id="{{$value->projet_id}}" projet_nom="{{$value->projet_nom}}" class="btn btn-default">Charger</button>
                        <button id="btn_projet_modifier" projet_id="{{$value->projet_id}}" projet_nom="{{$value->projet_nom}}" class="btn btn-default">Modifier</button>
                    </div>
                </div>
            @endforeach
            </div>
        </fieldset>
    </div>
@elseif(!isset($dataProjetRapide))
    <p>Aucun projet</p>
@endif


<h1 id="titre_projet"></h1>
<p id="message"></p>
   <div id="center-wrapper" style="display:none;" >
       <!-- <div id="dialog" title="Tab data">
          <form>
            <fieldset class="ui-helper-reset">
              <label for="tab_no">Numero</label>
              <input type="text" name="tab_no" id="tab_no" placeholder="Tab Title" class="ui-widget-content ui-corner-all">
              <label for="tab_content">Content</label>
              <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">Tab content</textarea>
            </fieldset>
          </form>
        </div> -->


        <div id="tabs">
          <ul>
  <!--           <li><a href="#tabs-1">Nunc tincidunt</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>    -->
          </ul>

<!--
            <div id="tabs-1">

                <div class="container-list-lvl2" id="container-list-lvl2">

                </div>
            </div>
-->



    </div>  <!-- #center-wrapper -->

    <div id="tache_commentaire" class="btn_fermer_ui" style="display:none">
       

    </div>
    <div id="tache_info" class="btn_fermer_ui" style="display:none">
      

    </div>



<div class="div_tache_form"  style="display:none">
    <form id="form_tache" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Ajouter une tache</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tache</label>
                        <input type="text" class="form-control" id="nom_tache" name="nom_tache" placeholder="Nom" />
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tache</label>
                        <textarea class="form-control" id="description_tache" name="description_tache" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="btn_tache_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_tache_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>
    </form>
</div>

<div id="tache_modifier_form" style="display:none">
    <form id="form_modifier_tache" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Modifier une tache</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tache</label>
                        <input type="text" class="form-control" id="modifier_nom_tache" name="modifier_nom_tache" placeholder="Nom" />
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tache</label>
                        <textarea class="form-control" id="modifier_description_tache" name="modifier_description_tache" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="btn_tache_modifier" class="btn btn-primary" >Modifier</button>
                    <button type="button" id="btn_tache_modifier_annuler" class="btn btn-primary" >Annuler</button>
                </div>
        </fieldset>

    </form>

</div>

<div class="div_liste_form" style="display:none">
    <form id="form_liste" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Ajouter une liste</legend>
                <div class="form-group">
                        <label for="nom_liste">Nom de la liste</label>
                        <input type="text" class="form-control" id="nom_liste" name="nom_liste" placeholder="Liste" />
                </div>
                <div class="form-group">
                         <label for="description_liste">Description de la liste</label>
                        <textarea class="form-control" id="description_liste" name="description_liste" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="btn_liste_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_liste_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>

    </form>

</div>
<div class="div_projet_form"  style="display:none">
    <form id="form_projet" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Créer un projet</legend>
                <div class="form-group">
                        <label for="nom_projet">Nom du projet</label>
                        <input type="text" class="form-control" id="nom_projet" name="nom_projet" placeholder="Nom" />
                </div>
                <div class="form-group">
                         <label for="description_projet">Description du projet</label>
                        <textarea class="form-control" id="description_projet" name="description_projet" placeholder="Description"></textarea>
                </div>
                <div class="form-group" >
                    <label for="date_du_projet">Date dû :</label>
                    <input type="text" class="form-control" name="date_du_projet" id="date_du_projet">
                </div>
                <script type="text/javascript">
                    $( function() {
                        $( "#date_du_projet" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                </script>
                <div class="form-group">
                    <button type="button" id="btn_projet_ajouter" class="btn btn-primary" >Créer</button>
                    <button type="button" id="btn_projet_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>
    </form>
</div>

<div id="projet_modifier_form" style="display:none">
    <form id="form_modifier_projet" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Modifier un projet</legend>
                <div class="form-group">
                    <div id="projet_message_modifier" style="display:none;text-align:left;color:darkred;background-color:#DEECF7; border-style:groove;"></div>­­
                </div>
                <div class="form-group">
                        <label for="nom_projet">Nom du projet</label>
                        <input type="text" class="form-control" id="modifier_nom_projet" name="modifier_nom_projet" placeholder="Nom" />
                </div>
                <div class="form-group">
                         <label for="description_liste">Description du projet</label>
                        <textarea class="form-control" id="modifier_description_projet" name="modifier_description_projet" placeholder="Description">
                        Description</textarea>
                </div>
                <div class="form-group" >
                    <label for="date_du_projet">Date dû :</label>
                    <input type="text" class="form-control" name="modifier_date_du_projet" id="modifier_date_du_projet">
                </div>
                <div class="form-group" >
                    <label for="date_complete_projet">Date complété :</label>
                    <input type="text" class="form-control" name="modifier_date_complete_projet" id="modifier_date_complete_projet">
                </div>
                <script type="text/javascript">
                    $( function() {
                        $( "#modifier_date_du_projet" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                    $( function() {
                        $( "#modifier_date_complete_projet" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                </script>
                <div class="form-group">
                    <button type="button" id="btn_projet_formmodifier" class="btn btn-primary" >Modifier</button>
                    <button type="button" id="btn_projet_formmodifier_annuler" class="btn btn-primary" >Annuler</button>
                </div>
        </fieldset>

    </form>

</div>

<div class="div_sprint_form" style="display:none">
    <form id="form_sprint" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Ajouter un sprint</legend>
             <div class="form-group">
                        <label for="no_sprint">Numero du sprint</label>
                        <input type="text" class="form-control" id="no_sprint" name="no_sprint" placeholder="Sprint" />
                </div>
                <div class="form-group" >
                    <label for="date_debut">Date Début :</label>
                    <input type="text" class="form-control" name="date_debut" id="date_debut">
                </div>
                <div class="form-group" >
                    <label for="date_fin">Date Fin :</label>
                    <input type="text" class="form-control" name="date_fin" id="date_fin">
                </div>
                <script type="text/javascript">
                    $( function() {
                        $( "#date_debut" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                    $( function() {
                        $( "#date_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                </script>
                <div class="form-group">
                    <button type="button" id="btn_sprint_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_sprint_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>

    </form>

</div>


<div id="liste_modifier_form" style="display:none">
    <form id="form_modifier_liste" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Modifier une liste</legend>
                <div class="form-group">
                  <div id="liste_message_modifier" class="alert alert-warning">{{ Session::get('liste_message_modifier') }}</div>
                </div>
                <div class="form-group">
                        <label for="nom_liste">Nom de la liste</label>
                        <input type="text" class="form-control" id="modifier_nom_liste" name="modifier_nom_liste" placeholder="Nom" />
                </div>
                <div class="form-group">
                         <label for="description_liste">Description de la liste</label>
                        <textarea class="form-control" id="modifier_description_liste" name="modifier_description_liste" placeholder="Description">
                        autretest</textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="btn_liste_modifier" class="btn btn-primary" >Modifier</button>
                    <button type="button" id="btn_liste_formmodifier_annuler" class="btn btn-primary" >Annuler</button>
                </div>
        </fieldset>

    </form>

</div>


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

@endsection
