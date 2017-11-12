
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
              <a class="navbar-brand" href="#">Projet Rapide</a>
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






<p id="message"></p>
   <div id="center-wrapper"> 
       <div id="dialog" title="Tab data">
          <form>
            <fieldset class="ui-helper-reset">
              <label for="tab_no">Numero</label>
              <input type="text" name="tab_no" id="tab_no" placeholder="Tab Title" class="ui-widget-content ui-corner-all">
              <label for="tab_content">Content</label>
              <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">Tab content</textarea>
            </fieldset>
          </form>
        </div>
         
        <button id="add_tab">Add Tab</button>
         
        
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Nunc tincidunt</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
          </ul>
            <div id="tabs-1">
                <!-- Les listes viennent ici -->
                <div class="container-list-lvl2" id="container-list-lvl2">
            
                </div> 
            </div>
        </div>
   <!--  <h2 id="sprint_no">Sprint 1</h2>
        <div class="row">
            <h2>GET</h2>
            <button id="getTaches" type="button" class="btn btn-primary">GET</button>
        </div> 
        <div id="getTachesData">
            
        </div>

            
    
    </div>  --> 

           
        
    </div>  <!-- #center-wrapper -->





<div class="div_tache_form" style="display:none">
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
                        <input type="text" class="form-control" id="nom_tache" name="nom_tache" placeholder="Nom" value=test />
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tache todo</label>
                        <textarea class="form-control" id="description_tache" name="description_tache" placeholder="Description">autretest</textarea>
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
                <script type="text/javascript">
                    $( function() {
                        $( "#date_debut" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                    $( function() {
                        $( "#date_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                </script>
                <div class="form-group" >
                    <label for="date_fin">Date Fin :</label>
                    <input type="text" class="form-control" name="date_fin" id="date_fin">
                </div>
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
                        <label for="nom_liste">Nom de la liste</label>
                        <input type="text" class="form-control" id="nom_liste" name="nom_liste" placeholder="Nom" value=test />
                </div>
                <div class="form-group">
                         <label for="description_liste">Description de la tache</label>
                        <textarea class="form-control" id="description_liste" name="description_liste" placeholder="Description">
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