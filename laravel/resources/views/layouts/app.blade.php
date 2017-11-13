<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>Projet Rapide</title>

        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">



        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>


  <script>

    <?php ini_set('display_errors', 'On'); ?>


  </script>

        <script type="text/javascript">

            var projet_id  = 1;
            // var sprint_id  = 1;

         // sur double-click d'une t�che
           $("body").delegate('li','dblclick',function() {

                var tache_id =  $(this).attr('id');
                //alert("bonjour "+tache_id);
                //on s'assure que le <li> cliqu� est une t�che sinon exit
                //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd
                if(!(typeof tache_id != 'undefined' && tache_id.indexOf("li_tache") >= 0)){
                  return;
                }
                $tache_no = tache_id.replace("li_tache_", "");
                $("body").data("modif_tache_no", $tache_no);

                $.blockUI({
                     message: $('#tache_modifier_form')
                });
              });

              // Modifier un tâche
               $("body").delegate('#btn_tache_modifier_annuler','click',function(){
             // $('#btn_tache_modifier_annuler').click(function() {
                  //$('#form_modifier_tache')[0].reset();
                  alert("annuler");
                  $.unblockUI();
                  return false;
              });

              $("body").delegate('#btn_tache_modifier','click',function(){
                  $tache_no = $("body").data("modif_tache_no");
                  alert("tache_numéro " + $tache_no);
                  //var donnees_form = $('#form_modifier_tache').serialize();
                  var input_name = "nom_tache";
                  var nom_tache = $("#form_modifier_tache :input[name='"+input_name+"']").val();
                  //input_name = "description_tache"; 
                  //var description_tache = $("#form_modifier_tache :input[name='"+input_name+"']").val(); 
                  
                  //alert(nom_tache + " " + description_tache);

                  if(nom_tache == ""){
                      nom_tache = "Non Défini";
                  }
                  $url = "taches/" + $tache_no;
                  alert($url);

                  $.ajax({ statusCode: {
                      500: function(xhr) {
                       alert(500);
                      }},
                      //the route pointing to the post function
                      url: $url,
                      type: 'PUT',
                      // send the csrf-token and the input to the controller
                      data: $('#form_modifier_tache').serialize(),
                      dataType: 'text',
                      // remind that 'data' is the response of the AjaxController
                  success: function (result,status,xhr) {
                      var tache_no = $("body").data("modif_tache_no");
                  },error(xhr,status,error){
                      alert("error 1 " + status);
                      alert("error 2 " + error);
                  },

                      complete: function (xhr,status) {
                        var spanAModifier = "tache_titre_" + $tache_no;
                        document.getElementById(spanAModifier).innerHTML = nom_tache;

                        // Handle the complete event
                       alert("complete " + status);
                      }
                  });
                  $.unblockUI();
                 
              });//#btn_tache_modifier
              // Fin modifier une tâche

            function ajouter_tache(liste_no){



                $.blockUI({
                     message: $('.div_tache_form')
                });



            } //ajouter_tache
            


             function creer_liste(id, nom, description){

                var sprint_id_name = $('#tabs .ui-state-active').attr('aria-controls');
                    alert(sprint_id_name);
                    var sprint_id = sprint_id_name.replace("tabs-", "");
                    alert(sprint_id);

                $liste = '<div class="container-list">'
                $liste +='    <div class="panel panel-default column left"  id="liste_' + id + '">'
                $liste +='        <div class="panel-heading" id="liste_panel_' + id + '">'
                $liste +='            <span id="liste_titre_' + id + '">' + nom + '</span>'
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

                $("#tabs-" + sprint_id).append($liste);

                $("#btn_ajouter_tache_Liste_" + id ).bind('click', function(e)
                {
                    e.preventDefault();
                    ajouter_tache();
                });


               
                $('.container-list .sortable-list').sortable({
                    connectWith: '.container-list .sortable-list',
                    placeholder: 'placeholder',
                    receive: function( event, ui ){


                        //on récupere le numéro de la liste
                        var liste_id_name = $(this).attr("id");
                        var liste_no = liste_id_name.replace("ul_liste_", "");

                        var tache_id_name = $(ui.item).attr("id");
                        var tache_no = tache_id_name.replace("li_tache_", "");
                        
                        
                        

                        var data =  "projet_id=" + projet_id + "&sprint_id=" + sprint_id + "&liste_id=" + liste_no + "&tache_id=" + tache_no;




                        $.ajax({ statusCode: {
                            500: function(xhr) {
                             alert(500);
                            }},
                            //the route pointing to the post function
                            url: "/sprintactivite" ,
                            type: 'POST',
                            // send the csrf-token and the input to the controller
                            data: data,
                            dataType: 'text',
                            // remind that 'data' is the response of the AjaxController
                        success: function (result,status,xhr) {

                               alert("drag drop successs");

                        },error(xhr,status,error){
                            alert("error 1 " + status);
                            alert("error 2 " + error);
                        },
                            complete: function (xhr,status) {
                                // Handle the complete event
                             alert("complete " + status);
                            }
                        });  //ajax
                                
                    } // update function

                }); //$('.container-list .sortable-list').sortable

            } //creer_liste

           // sur double-click d'un div aller chercher la liste pour cette fois-ci
           $("body").delegate('div','dblclick',function() {

                var liste_id =  $(this).attr('id');
                //alert("liste "+ liste_id);
                //on s'assure qu'on a bien cliqué sur la partie liste sinon exit
                if(!(typeof liste_id != 'undefined' && liste_id.indexOf("liste_panel_") >= 0)){
                        return;
                }
                var liste_no = liste_id.replace("liste_panel_", "");
                $("body").data("modif_liste_no", liste_no);

                $.blockUI({
                     message: $('#liste_modifier_form')
                });
              });

              // Annuler la modification d'une liste
               $("body").delegate('#btn_liste_formmodifier_annuler','click',function(){
                  //$('#form_modifier_liste')[0].reset();
                  $.unblockUI();
                  return false;
              });

              // Sur appuie du bouton modifier de la liste
              $("body").delegate('#btn_liste_modifier','click',function(){
                  //$('#form_modifier_tache')[0].reset();
                  //alert("modifier");

                  var liste_no = $("body").data("modif_liste_no");
                  
                  //var donnees_form = $('#form_modifier_liste').serialize();
                  var input_name = "nom_liste";
                  var nom_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val();
                  //input_name = "description_liste"; 
                  //var description_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val(); 
                  
                  //alert(nom_liste + " " + description_liste);

                  //alert("liste_no " + liste_no);
                  if(nom_liste == ""){
                      nom_liste = "Non Défini";
                  }
                  $url = "listes/" + liste_no;

                  $.ajax({ statusCode: {
                      500: function(xhr) {
                       alert(500);
                      }},
                      //the route pointing to the post function
                      url: $url,
                      type: 'PUT',
                      // send the csrf-token and the input to the controller
                      data: $('#form_modifier_liste').serialize(),
                      dataType: 'text',
                      // remind that 'data' is the response of the AjaxController
                  success: function (result,status,xhr) {
                  },error(xhr,status,error){
                      alert("error 1 " + status);
                      alert("error 2 " + error);
                  },

                      complete: function (xhr,status) {
                        var spanAModifier = "liste_titre_"+liste_no;
                        document.getElementById(spanAModifier).innerHTML = nom_liste;

                        // Handle the complete event
                       alert("complete " + status);
                      }
                  });
                  $.unblockUI();

              });//#btn_liste_modifier
              // Fin modifier une liste

            function afficherTache(data) {
                var tache = JSON.stringify(data);
                var tachef = JSON.parse(tache);

                $.each( JSON.parse(tachef), function( nom, value ) {
                    var nomTache = value.nom;
                    var idTache = value.id;
                    $("#ul_liste_" + 1).append( '<li id="li_da" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span id="tache_titre_' + idTache + '">' + nomTache + '</span></li>');
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
                 $('#btn_sprint_fermer').click(function() { 
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_sprint')[0].reset();
                    $.unblockUI(); 
                    return false; 
                }); //$('#btn_liste_fermer').click(function() 


               $('#btn_tache_ajouter').click(function() {



                    var liste_no = $("body").data("ajout_liste_no");
                    var nom_tache = $("#nom_tache").val();
                    var sprint_id_name = $("#tabs .ui-tabs-panel:visible").attr("id");
                    var sprint_id = sprint_id_name.replace("tabs-", "");

                    if(nom_tache == ""){
                        nom_tache = "Non Défini";

                    }

                    var data =  $('#form_tache').serialize() + "&projet_id=" + projet_id + "&sprint_id=" + sprint_id + "&liste_id=" + liste_no;

                    $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function
                        url: "{{ URL::to('taches') }}",
                        type: 'POST',
                        // send the csrf-token and the input to the controller
                        data: data,
                        dataType: 'text',
                        // remind that 'data' is the response of the AjaxController
                    success: function (result,status,xhr) {

                            var liste_no = $("body").data("ajout_liste_no");
                            $("#ul_liste_" + liste_no).append( '<li id="li_tache_' + JSON.parse(result).last_inserted_id + '" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span id="tache_titre_'+ JSON.parse(result).last_inserted_id + '">' + JSON.parse(result).nom + '</span></li>' );


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


                  
                    var sprint_id_name = $('#tabs .ui-state-active').attr('aria-controls');
                    alert(sprint_id_name);
                    var sprint_id = sprint_id_name.replace("tabs-", "");
                    alert(sprint_id);

                    var data =  $('#form_liste').serialize() + "&projet_id=" + projet_id + "&sprint_id=" + sprint_id
                  
                    $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function
                        url: "{{ URL::to('listes') }}",
                        type: 'POST',
                        // send the csrf-token and the input to the controller
                        data: data,
                        dataType: 'text',
                        // remind that 'data' is the response of the AjaxController
                    success: function (result,status,xhr) {

                            var id = JSON.parse(result).last_inserted_id;
                            var nom = JSON.parse(result).nom;
                            var description = JSON.parse(result).description;
                            creer_liste(id, nom, description);

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



                        var id = $(this).parent().attr("id");
                        var id_no = id.replace("li_tache_","");
                        var url = "taches/" + id_no;


                        $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function
                        url: url,
                        type: 'DELETE',

                    success: function (result,status,xhr) {

                          $('#' + id).parent().remove();

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

           
                

                $(document).on("click", "#creer_item_sprint", function() {
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_sprint')[0].reset();
                    $.blockUI({ 
                        message: $('.div_sprint_form') 
                    }); 
                    
                }); //$(document).on("click", "#creer_item_liste", function() {
   

                $( function() {
                var noSprint = $( "#no_sprint" ),
                  tabContent = $( "#tab_content" ),
                  tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
                  tabCounter = 2;
             
                var tabs = $( "#tabs" ).tabs();
             
                // Modal dialog init: custom buttons and a "close" callback resetting the form inside
                // var dialog = $( "#dialog" ).dialog({
                //   autoOpen: false,
                //   modal: true,
                //   buttons: {
                //     Add: function() {
                //       addTab();
                //       $( this ).dialog( "close" );
                //     },
                //     Cancel: function() {
                //       $( this ).dialog( "close" );
                //     }
                //   },
                //   close: function() {
                //     form[ 0 ].reset();
                //   }
                // });
             
                //AddTab form: calls addTab function on submit and closes the dialog
                $('#btn_sprint_ajouter').click(function() { 

                    $.ajax({ 

                            url: "{{ URL::to('sprints') }}",
                            type: 'POST',
                            data: $('#form_sprint').serialize(),
                            dataType: 'text',

                        success: function (result,status,xhr) {
     
                                var id = JSON.parse(result).last_inserted_id;
                                var numero = JSON.parse(result).numero;

                                // creer_sprint($id, $numero);
                                addTab(id, numero);

                        },
                        error(xhr,status,error){
                            alert("error 1 " + status);
                            alert("error 2 " + error);
                        }

                    });
                }); //$('#btn_tache_ajouter').click(function()
             
                // Actual addTab function: adds new tab using the input from the form above
                function addTab(id, numero) {
                  var label = noSprint.val() || "Sprint " + tabCounter,
                    id = "tabs-" + tabCounter,
                    li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
                    tabContentHtml = tabContent.val();
             
                  tabs.find( ".ui-tabs-nav" ).append( li );
                  tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
                  tabs.tabs( "refresh" );
                  tabCounter++;
                }
                

                // $( "#creer_item_sprint" ).button().on( "click", function() {
                //     dialog.dialog( "open" );
                //   });
             
                // Close icon: removing the tab on click
                tabs.on( "click", "span.ui-icon-close", function() {
                  var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
                  $( "#" + panelId ).remove();
                  tabs.tabs( "refresh" );
                });
             
                tabs.on( "keyup", function( event ) {
                  if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
                    var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
                    $( "#" + panelId ).remove();
                    tabs.tabs( "refresh" );
                  }
                });
               });
}); //$(document).ready(function()





        </script>
</header>
    <body>
        @yield('content')





     </body>
</html>
