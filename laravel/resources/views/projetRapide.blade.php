
 @extends('layouts.projetLayout')

@section('content')




        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div id="brand" class="navbar-header">
              <button type="button" id="btn_dropdown" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/home">Projet Rapide</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="top-right links" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="caret"></span></a>
                  <ul id="creer_item" class="dropdown-menu">
                    <li><a id="creer_item_projet" href="#">Projet</a></li>
                    <li><a id="creer_item_sprint" href="#">Sprint</a></li>
                    <li><a id="creer_item_liste" href="#">Liste</a></li>
                    <li><a id="gerer_utilisateurs" href="#">Utilisateurs</a></li>
                  </ul>
                </li>
              </ul>

            </div><!-- /.navbar-collapse -->


             <a id="logout" href="{{ route('logout') }}" rel="tooltip" title="Logout" class="navbar-brand logout pull right"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  <span class="glyphicon glyphicon-log-out"></span>
              </a>



               <div id="div_menu_commentaire_projet" class="navbar-brand  pull right" style="display:none;" >
                <a href="#" id="btn_menu_commentaire_projet" data-toggle="modal" data-target="#projet_commentaire" rel="tooltip" title="Commentaires"  style="color:white;"><span class="glyphicon glyphicon-comment"></span>
                </a>
            </div>

            </div><!-- /.container-fluid -->
        </nav>

<hr />













<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>


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

                        <form id="form_assignation" action="#" >
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <!-- securite contre les failles sur les requests -->

                          <fieldset>
                              <legend>Assigner un utilisateur au projet : </legend>
                                  <div class="form-group">
                                          <label for="nom_assignation">Nom de l'utilisateur</label>
                                          <input id="search-bar" name="search-bar" type="text" class="form-control" placeholder="Rechercher"/>
                                  </div>

                                  <div class="form-group">
                                      <button type="button" id="btn_assignation" class="btn btn-primary" >Ajouter</button>
                                  </div>
                          </fieldset>
                      </form>
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
        </div>
<!--
            <div id="tabs-1">

                <div class="container-list-lvl2" id="container-list-lvl2">

                </div>
            </div>
-->



    </div>  <!-- #center-wrapper -->


    <div id="tache_commentaire" style="display:none">
        <a href="#"><span class='glyphicon glyphicon-remove btn_fermer_ui pull-right' style='color:#BBB;'></span></a>

        <div class="container">


        </div>
    </div>




    </div>
    <div id="tache_info" class="btn_fermer_ui" style="display:none">


    </div>



<div class="div_tache_form"  style="display:none">
    <form id="form_tache" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Ajouter une tâche</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tâche</label>
                        <input type="text" class="form-control" id="nom_tache" name="nom_tache" placeholder="Nom" />
                        <input type="hidden" id="ajouter_tache_id"></input>
                        <input type="hidden" id="ajouter_tache_liste_id"></input>
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tâche</label>
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
            <legend>Modifier une tâche</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tâche</label>
                        <input type="text" class="form-control" id="modifier_nom_tache" name="modifier_nom_tache" placeholder="Nom" />
                        <input type="hidden" id="modifier_tache_id" ></input>
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tâche</label>
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
                <div id="liste_message_ajouter" class="alert alert-warning">{{ Session::get('liste_message_ajouter') }}</div>
              </div>
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
                    <input type="text" class="form-control date" name="date_du_projet" id="date_du_projet">
                </div>
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
                    <input type="text" class="form-control date" name="modifier_date_complete_projet" id="modifier_date_complete_projet">
                </div>
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
                        <div id="sprint_message_ajouter" class="alert alert-warning">{{ Session::get('sprint_message_ajouter') }}</div>
                </div>
                <div class="form-group">
                        <label for="no_sprint">Numero du sprint</label>
                        <input type="text" class="form-control" id="no_sprint" name="no_sprint" placeholder="Sprint" />
                </div>
                <div class="form-group" >
                    <label for="date_debut">Date Début :</label>
                    <input type="text" class="form-control date" name="date_debut" id="date_debut">
                </div>
                <div class="form-group" >
                    <label for="date_fin">Date Fin :</label>
                    <input type="text" class="form-control date" name="date_fin" id="date_fin">
                </div>
                <div class="form-group">
                    <button type="button" id="btn_sprint_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_sprint_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>

    </form>

</div>


<!-- Permet de gérer les utilisateurs, les ajouter, les supprimer, les rendre actifs ou inactifs-->
<div class="div_utilisateurs_form"  style="display:none">
    <form id="form_gerer_utilisateurs" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->
            <legend>Gérer les utilisateurs</legend>
            <div class="utilisateurs_form_ajouter_listes"></div>
            <!-- TODO : insérer ici les listes des utiliateurs actifs et inactifs -->

            <div class="form-group">
                    <button type="button" id="btn_utilisateurs_fermer" class="btn btn-primary" >Fermer</button>
            </div>
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
                        <input type="hidden" id="modifier_liste_id"></input>
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

<div class="div_ajouter_utilisateur_form"  style="display:none">
    <form id="form_utilisateur" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Ajouter un utilisateur</legend>

                <div class="form-group">
                  <div id="utilisateur_message_ajouter" class="alert alert-warning">{{ Session::get('utilisateur_message_ajouter') }}</div>
                </div>

                <div class="form_groupe">
                  <select id="selection_type_utilisateur">
                         <option value="2" data-value="item_type_utilisateur_2">Utilisateur</option>
                         <option value="3" data-value="item_type_utilisateur_3">Client</option>
                         <option value="1" data-value="item_type_utilisateur_1">Gestionnaire de Projet</option>
                  </select>
                </div>

                <div id="ajouter_utilisateur_type_1_et_type_2" style="display:none">
                  <div class="form-group">
                          <label for="prenom_utilisateur">Prénom de l'utilisateur</label>
                          <input type="text" class="form-control" id="prenom_utilisateur" name="nom_utilisateur" placeholder="Prenom" />
                  </div>
                  <div class="form-group">
                          <label for="nom_utilisateur">Nom de l'utilisateur</label>
                          <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" placeholder="Nom" />
                  </div>
                  <div class="form-group">
                          <label for="courriel_utilisateur">Courriel de l'utilisateur</label>
                          <input type="text" id="courriel_utilisateur" name="courriel_utilisateur" placeholder="Courriel de l'utilisateur"></textarea>
                  </div>
                  <div class="form-group">
                          <label for="telephone_utilisateur">Téléphone de l'utilisateur</label>
                          <input type="text" id="telephone_utilisateur" name="telephone_utilisateur" placeholder="Téléphone de l'utilisateur"></textarea>
                  </div>
                </div>
                <div id="ajouter_utilisateur_type_3" style="display:none">
                  <div class="form-group">
                          <label for="nom_client">Nom du client</label>
                          <input type="text" class="form-control" id="nom_client" name="nom_client" placeholder="Nom" />
                  </div>
                  <div class="form-group">
                           <label for="contact_client">Nom du contact client</label>
                          <input type="text" id="contact_client" name="contact_client" placeholder="La personne à contacter"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="telephone_client">Téléphone du client</label>
                          <input type="text" id="telephone_client" name="telephone_client" placeholder="Téléphone du client"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="adresse_client">Adresse du client</label>
                          <textarea class="form-control" id="adresse_client" name="adresse_client" placeholder="Adresse du client"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="code_postal_client">Code postal du client</label>
                          <input type="text" id="code_postal_client" name="code_postal_client" placeholder=""></textarea>
                  </div>
                </div>
                <div class="form-group">
                    <button type="button" id="btn_utilisateur_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_utilisateur_ajouter_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>
    </form>
</div>

<div id="utilisateur_modifier_form" style="display:none">
    <form id="form_modifier_utilisateur" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->

        <fieldset>
            <legend>Modifier un utilisateur</legend>
                <div class="form-group">
                  <div id="utilisateur_message_modifier" class="alert alert-warning">{{ Session::get('utilisateur_message_modifier') }}</div>
                </div>

                <div id="modifier_utilisateur_type_1_et_type_2" style="display:none">
                  <div class="form-group">
                    <label for="type_utiliateur">Type de l'utilisateur</label>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="caret"></span></a>
                      <ul id="dd_type_utilisateur_modifier" class="dropdown-menu">
                        <li><a id="item_modifier_type_1" href="#">Gestionnaire de Projet</a></li>
                        <li><a id="item_modifier_type_2" href="#">Utilisateur</a></li>
                      </ul>
                    </li>
                  </div>
                  <div class="form-group">
                          <label for="prenom_utilisateur">Prénom de l'utilisateur</label>
                          <input type="text" class="form-control" id="modifier_prenom_utilisateur" name="modifier_nom_utilisateur" placeholder="Prenom" />
                  </div>
                  <div class="form-group">
                          <label for="nom_utilisateur">Nom de l'utilisateur</label>
                          <input type="text" class="form-control" id="modifier_nom_utilisateur" name="modifier_nom_utilisateur" placeholder="Nom" />
                  </div>
                  <div class="form-group">
                          <label for="courriel_utilisateur">Courriel de l'utilisateur</label>
                          <input type="text" id="modifier_courriel_utilisateur" name="modifier_courriel_utilisateur" placeholder="Courriel de l'utilisateur"></textarea>
                  </div>
                  <div class="form-group">
                          <label for="telephone_utilisateur">Téléphone de l'utilisateur</label>
                          <input type="text" id="modifier_telephone_utilisateur" name="modifier_telephone_utilisateur" placeholder="Téléphone de l'utilisateur"></textarea>
                  </div>
                </div>

                <div id="modifier_utilisateur_type_3" style="display:none">
                  <div class="form-group">
                          <label for="nom_client">Nom du client</label>
                          <input type="text" class="form-control" id="modifier_nom_client" name="modifier_nom_client" placeholder="Nom" />
                  </div>
                  <div class="form-group">
                           <label for="contact_client">Nom du contact client</label>
                          <input type="text" id="modifier_contact_client" name="modifier_contact_client" placeholder="La personne à contacter"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="telephone_client">Téléphone du client</label>
                          <input type="text" id="modifier_telephone_client" name="modifier_telephone_client" placeholder="Téléphone du client"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="adresse_client">Adresse du client</label>
                          <textarea class="form-control" id="modifier_adresse_client" name="modifier_adresse_client" placeholder="Adresse du client"></textarea>
                  </div>
                  <div class="form-group">
                           <label for="code_postal_client">Code postal du client</label>
                          <input type="text" id="modifier_code_postal_client" name="modifier_code_postal_client" placeholder=""></textarea>
                  </div>
                </div>

        </fieldset>

    </form>

</div>

<div class="container projetrapide_sidebar" >
    <!-- Modal -->
    <div class="modal right fade" id="projet_commentaire" tabindex="-1" role="dialog" aria-labelledby="label_commentaire">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="label_commentaire">Commentaires</h4>
                    <div  class="div_commentaire_projet form-group col-lg-8">
                        <form id="form_commentaire_projet">
                            <textarea  class="form-control input-group-lg" placeholder="Commentaire"></textarea>
                            <button id="btn_commentaire_projet" class="btn btn-default">Envoyer</button>
                        </form>
                    </div>
                </div>

                <div class="modal-body" id="commentaire_projet">

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->


</div><!-- container -->


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

@endsection
