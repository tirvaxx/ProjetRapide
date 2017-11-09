
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
    <h2 id="sprint_no">Sprint 1</h2>
        <div class="row">
            <h2>GET</h2>
            <button id="getTaches" type="button" class="btn btn-primary">GET</button>
        </div>
        <div id="getTachesData">
            
        </div>
        



        <div class="container-list-lvl2" id="container-list-lvl2">
            


            <div class="container-list"> 
                <div class="panel panel-default column left"  id="liste_1">
                        <div class="panel-heading">
                            <span>liste 1</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list" id="ul_liste_1">
                                    <li id="li_c" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item C</span>
                                            </li>
                                    <li id="li_da" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item D</span>
                                    </li>
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#" id="btn_ajouter_tache_Liste_1" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->
            


            <div class="container-list"> 
                <div class="panel panel-default column left">
                        <div class="panel-heading">
                            <span>liste 2</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list" id="ul_liste_2" >
                                            <li id="li_a" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item A</span>
                                            </li>
                                            <li id="li_b" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item B</span>
                                            </li>
                                          
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#"  id="btn_ajouter_tache_Liste_2" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->

        </div> <!-- #container-list-lvl2 -->
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



        <script type="text/javascript">
         
            function ajouter_tache(liste_no){


          
                $.blockUI({ 
                     message: $('.div_tache_form') 
                }); 

             

            } //ajouter_tache

 
             function creer_liste(id, nom, description){

                $liste = '<div class="container-list">'
                $liste +='    <div class="panel panel-default column left"  id="liste_' + id + '">'
                $liste +='        <div class="panel-heading">'                                                                 
                $liste +='            <span>' + nom + '</span>'
                $liste +='        </div>  <!-- panel-heading -->'
                $liste +='        <div class="panel-body">'
                $liste +='            <ul class="sortable-list" id="ul_liste_' + id + '">'
                $liste +='            </ul>'
                $liste +='        </div> <!-- panel-body -->'
                $liste +='        <div class="panel-footer">'
                $liste +='            <a href="#" id="btn_ajouter_tache_Liste_' + id + '" class="btn btn-link right">ajouter une tache</a>'
                $liste +='        </div> <!-- panel-footer -->'
                $liste +='    </div>  <!-- panel-default -->'
                $liste +='</div>  <!-- #container-liste -->'

                $("#container-list-lvl2").append($liste);

                $("#btn_ajouter_tache_Liste_" + id ).bind('click', function(e) 
                {   
                    e.preventDefault();
                    ajouter_tache();
                });


                // Example 1.3: Sortable and connectable lists with visual helper
                $('.container-list .sortable-list').sortable({
                    connectWith: '.container-list .sortable-list',
                    placeholder: 'placeholder',
                });

            } //creer_liste
       
            function afficherTache(data) {
                var tache = JSON.stringify(data);
                var tachef = JSON.parse(tache);
                
                $.each( JSON.parse(tachef), function( nom, value ) {
                    var nomTache = value.nom;
                    $("#ul_liste_" + 1).append( '<li id="li_da" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span>' + nomTache + '</span></li>');  
                });
       
            }
     

$(document).ready(function() {
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
            });
             
                //$('#getTaches').on('click',function(){
            /*        $.get("{{URL::to('/getTaches')}}", function(data){
                        $('#getTachesData').append(data);
                        afficherTache(data);
                    });    
            */
               // })
                



                $('#btn_tache_fermer').click(function() { 
                    $("body").removeData("ajout_liste_no");
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_tache')[0].reset();
                    $.unblockUI(); 
                    return false; 
                }); //$('#btn_tache_fermer').click(function()

                 $('#btn_liste_fermer').click(function() { 
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_liste')[0].reset();
                    $.unblockUI(); 
                    return false; 
                }); //$('#btn_liste_fermer').click(function() 

               $('#btn_tache_ajouter').click(function() { 
   
              
                    var liste_no = $("body").data("ajout_liste_no");
                    var nom_tache = $("#nom_tache").val();
                    if(nom_tache == ""){
                        nom_tache = "Non Défini";

                    }
                               
                
                    $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function 
                        url: "{{ URL::to('taches') }}",
                        type: 'POST',
                        // send the csrf-token and the input to the controller 
                        data: $('#form_tache').serialize(),
                        dataType: 'text',
                        // remind that 'data' is the response of the AjaxController 
                    success: function (result,status,xhr) {
                            
                            var liste_no = $("body").data("ajout_liste_no");
                            $("#ul_liste_" + liste_no).append( '<li id="li_tache_' + JSON.parse(result).last_inserted_id + '" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span>' + JSON.parse(result).nom + '</span></li>' );


                    },error(xhr,status,error){
                        alert("error 1 " + status);
                        alert("error 2 " + error);
                    },
                        complete: function (xhr,status) {
                            // Handle the complete event
                         alert("complete " + status);
                        }
                    });

                    
                 }); // $('#btn_tache_ajouter').click(function()
             
                $('#btn_liste_ajouter').click(function() { 
   
                     $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function 
                        url: "{{ URL::to('listes') }}",
                        type: 'POST',
                        // send the csrf-token and the input to the controller 
                        data: $('#form_liste').serialize(),
                        dataType: 'text',
                        // remind that 'data' is the response of the AjaxController 
                    success: function (result,status,xhr) {
                            
                            $id = JSON.parse(result).last_inserted_id;
                            $nom = JSON.parse(result).nom;
                            $description = JSON.parse(result).description;
                            creer_liste($id, $nom, $description);

                    },
                    error(xhr,status,error){
                        alert("error 1 " + status);
                        alert("error 2 " + error);
                    },
                    complete: function (xhr,status) {
                            // Handle the complete event
                         alert("complete " + status);
                    }
                    });
                    $('#form_liste')[0].reset();
                }); // $('#btn_liste_ajouter').click(function()


            
                $("body").delegate('a.btn','click', function() { 
                    var list_id_from_a =  $(this).attr('id');

        
                    //on s'assure que le <a> cliquer est un bouton pour ajouter une tache sinon exit
                    //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd 
                    if(!(typeof list_id_from_a != 'undefined' && list_id_from_a.indexOf("btn_ajouter_tache_Liste") >= 0)){
                        
                        return;
                    }
                
                    var liste_no = list_id_from_a.replace("btn_ajouter_tache_Liste_", "");
                    $("body").data("ajout_liste_no", liste_no);
                    ajouter_tache(liste_no );
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_tache')[0].reset();


                }); //$("body").delegate('a.btn','click', function() 
            

                //utilisation de delegate au lieu de juste click car la fonctionalité est 
                //ajouté dynamiquement... sinon, ca ne marche pas
                $("body").delegate('a.x-remove','click',function() {
                        

                        
                        $id = $(this).parent().attr("id");
                        $id_no = $id.replace("li_tache_","");
                        $url = "taches/" + $id_no;
                        $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function 
                        url: $url,
                        type: 'DELETE',
                       
                    success: function (result,status,xhr) {
                            
                          $(this).parent().remove();

                    },error(xhr,status,error){
                        alert("error 1 " + status);
                        alert("error 2 " + error);
                    },
                        complete: function (xhr,status) {
                            // Handle the complete event
                         alert("complete " + status);
                        }
                    });
                          
                            
                }); // $("body").delegate('a.x-remove','click',function()
                $(document).on("click", "#creer_item_liste", function() {
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_liste')[0].reset();
                    $.blockUI({ 
                         message: $('.div_liste_form') 
                    }); 

                     
                }); // $(document).on("click", "#creer_item_liste", function()
           

   
}); //$(document).ready(function()



        </script>

        

    
     
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

@endsection