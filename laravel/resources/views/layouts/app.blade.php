<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>Projet Rapide</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>


  <script>

    <?php ini_set('display_errors', 'On'); ?>









/*
https://stackoverflow.com/questions/28386534/post-request-with-jquery-and-laravel-framework
$(function(){
         $.post(Urldir,{ _token: $('meta[name=csrf-token]').attr('content'), _method : 'PUT', data :  }, function(response){

               if(response != '')
                {
                 console.log('good');
                }

            });
        });

*/


  </script>

        <script type="text/javascript">

            var projet_id  = 1;
            var sprint_id  = 1;

            // sur double-click d'une t�che
            $("body").delegate('li','dblclick',function() {

                var tache_id =  $(this).attr('id');
                //on s'assure que le <li> cliqu� est une t�che sinon exit
                //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd
                if(!(typeof tache_id != 'undefined' && tache_id.indexOf("li_tache") >= 0)){
                  return;
                }
                $tache_no = tache_id.replace("li_tache_", "");
                $("body").data("modif_tache_no", $tache_no);

                  $url = "taches/" + $tache_no + "/edit";
                 
                // Partie ajax pour éditer le formulaire
                  $.ajax({ statusCode: {
                      500: function(xhr) {
                       alert(500);
                      }},
                      //the route pointing to the post function
                      url: $url,
                      type: 'GET',
                      dataType: 'text',
                  success: function (result,status,xhr) {
                      var la_tache = JSON.parse(result);
                      $('#modifier_nom_tache').val(la_tache.nom_tache);
                      $('#modifier_description_tache').val(la_tache.description_tache);

                  },error(xhr,status,error){
                      alert("error 1 " + status);
                      alert("error 2 " + error);
                  },

                      complete: function (xhr,status) {
                        // Handle the complete event
                        //alert("complete " + status);
                      }
                  }); // Fin partie ajax pour editer le formulaire
                
                $.blockUI({
                     message: $('#tache_modifier_form')
                });
            });

            // Modifier un tâche
            $("body").delegate('#btn_tache_modifier_annuler','click',function(){
                //alert("annuler");
                $.unblockUI();
                return false;
            });

            $("body").delegate('#btn_tache_modifier','click',function(){
                $tache_no = $("body").data("modif_tache_no");
                var input_name = "modifier_nom_tache";
                var nom_tache = $("#form_modifier_tache :input[name='"+input_name+"']").val();
                
                if(nom_tache == ""){
                     //confirm("Attention, vous devez entrer une tâche!");
                     
                    nom_tache = "Non défini";
                }
                if(description_tache == ""){
                    description_tache = "Non défini"
                }

                $url = "taches/" + $tache_no;

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
                    var spanAModifier = "tache_titre_" + $tache_no;
                    $('#'+spanAModifier).text(nom_tache);
                },error(xhr,status,error){
                    alert("error 1 " + status);
                    alert("error 2 " + error + " "+ xhr.responseText);
                },

                    complete: function (xhr,status) {
                    // Handle the complete event
                    //alert("complete PUT " + status);
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

                $liste = '<div class="container-list">'
                $liste +='    <div class="panel panel-default column left"  id="liste_' + id + '">'
                $liste +='        <div class="panel-heading" id="liste_panel_' + id + '" rel="tooltip" title="' + description + '">'
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

                               //alert("drag drop successs");

                        },error(xhr,status,error){
                            alert("error 1 " + status);
                            alert("error 2 " + error);
                        },
                            complete: function (xhr,status) {
                                // Handle the complete event
                             //alert("complete " + status);
                            }
                        });  //ajax
                                
                    } // update function

                }); //$('.container-list .sortable-list').sortable

            } //creer_liste



           // sur double-click d'un div aller chercher la liste pour cette fois-ci
           $("body").delegate('div','dblclick',function() {

                var liste_id =  $(this).attr('id');
                //on s'assure qu'on a bien cliqué sur la partie liste sinon exit
                if(!(typeof liste_id != 'undefined' && liste_id.indexOf("liste_panel_") >= 0)){
                        return;
                }
                var liste_no = liste_id.replace("liste_panel_", "");
                $("body").data("modif_liste_no", liste_no);

                $url = "listes/" + liste_no + "/edit";

                $.ajax({ statusCode: {
                    500: function(xhr) {
                    alert(500);
                    }},
                    //the route pointing to the post function
                    url: $url,
                    type: 'GET',
                    dataType: 'text',
                    
                success: function (result,status,xhr) {
                    var la_liste = JSON.parse(result);
                    $('#modifier_nom_liste').val(la_liste.nom_liste);
                    $('#modifier_description_liste').val(la_liste.description_liste);
                    $('#liste_message_modifier').hide();

                },error(xhr,status,error){
                    alert("error 1 " + status);
                    alert("error 2 " + error);
                },

                    complete: function (xhr,status) {
                    // Handle the complete event
                    //alert("complete " + status);
                    }
                });
                
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
                  
                var liste_no = $("body").data("modif_liste_no");
                var input_name = "modifier_nom_liste";
                var nom_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val();
                var input_name = "modifier_description_liste";
                var description_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val();
                
                var lblMessageListeModifier = "liste_message_modifier"; // Permet d'afficher un message d'erreur dans le formulaire.
                
                var ExpNom = /^[0-9a-zA-Z\s\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿç  Ç_]{2,40}$/;
                //var ExpDesc = /^[0-9a-zA-Z\s\r\n\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿçÇ_]{2,150}$/;
                var ExpDesc = /^[^;]{2,150}$/;

                var res_test_nom = nom_liste.match(ExpNom);
                var res_test_desc = description_liste.match(ExpDesc);
                
                if( nom_liste.replace(/\s/g, '') == "" ||
                    description_liste.replace(/\s/g, '') == "" || !res_test_nom || !res_test_desc){
                   
                    $('#'+lblMessageListeModifier).html("<tr><td width=\"20%\" style=\"vertical-align : middle; font-size: 35px;text-align:center;\"><span>&#9888</span></td><td width=\"80%\" style=\"vertical-align : middle;\">" + 
                    "<span><strong>Nom de la liste :</strong><br/>(2 à 40 caractères maximum acceptant les caratères : 0 à 9, a à z, A à Z, espace, point, àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿçÇ_)<br/><strong>Description de la liste :</strong><br/>(2 à 150 caractères).</span></td></tr>");
                    $('#'+lblMessageListeModifier).show();
                    message: $('#liste_modifier_form')
                    return;
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
                    
                    var tagAModifier = "liste_titre_"+liste_no;
                    $('#'+tagAModifier).text(nom_liste);

                    tagAModifier = "liste_panel_"+liste_no;
                    $('#'+tagAModifier).attr('title', description_liste);
                 
                },error(xhr,status,error){
                    alert("error 1 " + status);
                    alert("error 2 " + error);
                },
                    complete: function (xhr,status) {
                        // Remettre la partie message d'erreur du formulaire à rien et chacher cette partie
                        $('#'+lblMessageListeModifier).html("");
                        $('#'+lblMessageListeModifier).hide();
                    // Handle the complete event
                    //alert("complete " + status);
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
            
             //Permet d'afficher des tooltips de types Bootstrap 
            $("[rel=tooltip]").tooltip({ placement: 'top'});

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
                         //alert("complete " + status);
                        }
                    });


                 }); // $('#btn_tache_ajouter').click(function()

                $('#btn_liste_ajouter').click(function() {
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
                         //alert("complete " + status);
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
                         //alert("complete " + status);
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
</header>
    <body>
        @yield('content')





     </body>
</html>
