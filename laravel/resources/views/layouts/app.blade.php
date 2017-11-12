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
         
            function ajouter_tache(liste_no){


          
                $.blockUI({ 
                     message: $('.div_tache_form') 
                }); 

             

            } //ajouter_tache
            function creer_sprint(id, no) {

                

                
                // $sprint = '<div id="div_sprint_' + id + ' class="tabcontent" style="display : none ;">'
                // $sprint += '    <h3>'+ no + '</h3>'
                // $sprint += '    <p>Premier Sprint : </p>'
                // $sprint += '</div>'
                // alert($sprint);
                // $('#tabContenu').append($sprint);

                // alert("fonction creer");
                // $sprint_onglet = '<button class="tablinks" onclick="openTabSprint(event, ' + no + ')">Sprint ' + no + '</button>';
                // alert($sprint_onglet);

                // $('#tabLien').append($sprint_onglet);
                // $("div#tabLien").tabs("refresh");

                

            }

            function openTabSprint(evt, sprintNo) {
                    // Declare all variables
                var i, tabcontent, tablinks;
               

                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                alert(tabcontent);

                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                alert(tablinks);

                // Show the current tab, and add an "active" class to the button that opened the tab
                // $('document').getElementById("div_sprint_" + sprintNo).style.display = "block";
                $("#div_sprint_" + sprintNo).val().style.display = "block";
                evt.currentTarget.className += " active";

                alert(tabcontent);
            }


 
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
                 $('#btn_sprint_fermer').click(function() { 
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_sprint')[0].reset();
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
                   
                }); // $('#btn_liste_ajouter').click(function()

                $('#btn_sprint_ajouter').click(function() { 

                    $.ajax({ 

                            url: "{{ URL::to('sprints') }}",
                            type: 'POST',
                            data: $('#form_sprint').serialize(),
                            dataType: 'text',

                        success: function (result,status,xhr) {
     
                                $id = JSON.parse(result).last_inserted_id;
                                $numero = JSON.parse(result).numero;

                                creer_sprint($id, $numero);

                        },
                        error(xhr,status,error){
                            alert("error 1 " + status);
                            alert("error 2 " + error);
                        }

                    });
                }); //$('#btn_tache_ajouter').click(function()


            
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
                          
                          $('#' + $id).parent().remove();

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
                var tabTitle = $( "#tab_title" ),
                  tabContent = $( "#tab_content" ),
                  tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
                  tabCounter = 2;
             
                var tabs = $( "#tabs" ).tabs();
             
                // Modal dialog init: custom buttons and a "close" callback resetting the form inside
                var dialog = $( "#dialog" ).dialog({
                  autoOpen: false,
                  modal: true,
                  buttons: {
                    Add: function() {
                      addTab();
                      $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                      $( this ).dialog( "close" );
                    }
                  },
                  close: function() {
                    form[ 0 ].reset();
                  }
                });
             
                //AddTab form: calls addTab function on submit and closes the dialog
                var form = dialog.find( "form" ).on( "submit", function( event ) {
                  addTab();
                  dialog.dialog( "close" );
                  event.preventDefault();
                });
             
                // Actual addTab function: adds new tab using the input from the form above
                function addTab() {
                  var label = tabTitle.val() || "Tab " + tabCounter,
                    id = "tabs-" + tabCounter,
                    li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
                    tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";
             
                  tabs.find( ".ui-tabs-nav" ).append( li );
                  tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
                  tabs.tabs( "refresh" );
                  tabCounter++;
                }
             
                // AddTab button: just opens the dialog
                $( "#add_tab" )
                  .button()
                  .on( "click", function() {
                    dialog.dialog( "open" );
                  });
             
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
               } );
}); //$(document).ready(function()





        </script>
</header>
    <body>
        @yield('content')
    




     </body>    
</html>