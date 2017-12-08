
function ajouter_tache(){
    $.blockUI({
         message: $('.div_tache_form'),
         css: { top:'20%'}
    });
} //ajouter_tache



function get_all_liste_tache(sprint_id){
    var json;
    var json_ordre_tache;
    var ordre_tache;
    json_ordre_tache = '{'




    $( "#" + sprint_id + "> .container-list .sortable-list" ).each(function(){

var i;
console.log( i++);
        ordre_tache = String($(this).sortable("toArray"));
console.log( $(this).attr("id"));
console.log(ordre_tache);

        json_ordre_tache += '"' + $(this).attr("id") + '":';
        //if(ordre_tache != ""){

            json_ordre_tache += '{"ordre_tache":[' +  ordre_tache + ']}';

        //}
        json_ordre_tache += ",";
    });
    json_ordre_tache = json_ordre_tache.substr(0,json_ordre_tache.length-1);
    json_ordre_tache =  json_ordre_tache.replace(/li_tache_/g,"").replace(/ul_liste_/g,"");
    json_ordre_tache += '}';

   // alert(json_ordre_tache);
    //var sortedIDs = $( '.container-list .sortable-list' ).sortable( "toArray" );
    //alert(sortedIDs);

console.log(json_ordre_tache);
    return json_ordre_tache;

}




function creer_tache(liste_id, tache_id, tache_nom, tache_description){
     $("#ul_liste_" + liste_id).append( '<li id="li_tache_' + tache_id + '" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><a href="#"  class="c-comment"><span class="glyphicon glyphicon-comment pull-left"></a><a href="#" class="i-info"><span class="glyphicon glyphicon-info-sign pull-left"></a><span id="tache_titre_'+ tache_id + '">' + tache_nom + '</span></li>' );

}




$(document).ready(function(){

 // sur double-click d'une tache
    $("body").delegate('li','dblclick',function() {


        var tache_id =  $(this).attr('id');
        //on s'assure que le <li> cliqu� est une t�che sinon exit
        //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd
        if(!(typeof tache_id != 'undefined' && tache_id.indexOf("li_tache") >= 0)){
          return;
        }
        $tache_no = tache_id.replace("li_tache_", "");


         $url = "taches/" + $tache_no + "/edit";
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
            $('#modifier_nom_tache').val(la_tache.tache_nom);
            $('#modifier_description_tache').val(la_tache.tache_description);
            $("#modifier_tache_id").val($tache_no);
           // $('#tache_message_modifier').hide();

        },error(xhr,status,error){
            alert("error 1 " + status);
            alert("error 2 " + error);
        },

            complete: function (xhr,status) {
            // Handle the complete event
            //alert("complete " + status);
            }
        });

        // Partie ajax pour éditer le formulaire

        $.blockUI({
             message: $('#tache_modifier_form'),
             css: { top:'20%'}
        });
    }); //  $("body").delegate('li','dblclick',function

    // Modifier un tâche
    $("body").delegate('#btn_tache_modifier_annuler','click',function(){
     // $('#btn_tache_modifier_annuler').click(function() {
          //$('#form_modifier_tache')[0].reset();

          $.unblockUI();
          return false;
    }); // $("body").delegate('#btn_tache_modifier_annuler','click',function



	$("body").delegate('#btn_tache_modifier','click',function(){
	  
        $tache_no = $("#modifier_tache_id").val();
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



    $('#btn_tache_fermer').click(function() {
        //permet d'effacer les valeurs du form et recommencer à neuf
        $('#form_tache')[0].reset();
        $.unblockUI();
        return false;
    }); //$('#btn_tache_fermer').click(function()

   $('#btn_tache_ajouter').click(function() {

        var liste_no = $("#ajouter_tache_liste_id").val();
        var nom_tache = $("#nom_tache").val();

        var sprint_id_name = $("#tabs .ui-state-active").attr("aria-controls");
        var sprint_id = sprint_id_name.replace("sprint_", "");

        if(nom_tache == ""){
            nom_tache = "Non Défini";

        }

        var data =  $('#form_tache').serialize() + "&projet_id=" + g_selected_projet_id+ "&sprint_id=" + sprint_id + "&liste_id=" + liste_no;

        $.ajax({ statusCode: {
            500: function(xhr) {
             alert(500);
            }},
            //the route pointing to the post function
            url: '/taches',
            type: 'POST',
            // send the csrf-token and the input to the controller
            data: data,
            dataType: 'text',
            // remind that 'data' is the response of the AjaxController
        success: function (result,status,xhr) {

             
                 creer_tache(liste_no, JSON.parse(result).last_inserted_id, JSON.parse(result).nom , JSON.parse(result).description);
                /*
                $("#ul_liste_" + liste_no).append( '<li id="li_tache_' + JSON.parse(result).last_inserted_id + '" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span id="tache_titre_'+ JSON.parse(result).last_inserted_id + '">' + JSON.parse(result).nom + '</span></li>' );
                */


        },error(xhr,status,error){
            alert("error 1 " + status);
            alert("error 2 " + error);
        },complete: function (xhr,status) {
                // Handle the complete event
             //alert("complete " + status);
            }
        });


	}); // $('#btn_tache_ajouter').click(function()




    $("body").delegate('a.btn','click', function() {
        var list_id_from_a =  $(this).attr('id');



        //on s'assure que le <a> cliquer est un bouton pour ajouter une tache sinon exit
        //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd
        if(!(typeof list_id_from_a != 'undefined' && list_id_from_a.indexOf("btn_ajouter_tache_Liste") >= 0)){

            return;
        }

        var liste_no = list_id_from_a.replace("btn_ajouter_tache_Liste_", "");
       
        $("#ajouter_tache_liste_id").val(liste_no);
        ajouter_tache();
        //permet d'effacer les valeurs du form et recommencer à neuf
        $('#form_tache')[0].reset();


    }); //$("body").delegate('a.btn','click', function()




                //utilisation de delegate au lieu de juste click car la fonctionalité est
                //ajouté dynamiquement... sinon, ca ne marche pas
	$("body").delegate('a.x-remove','click',function() {

	    if(confirm("Voulez-vous supprimer la tâche?")){
	            var id = $(this).parent().attr("id");



	            $('#' + id).detach();

	            var sprint_id_name = $("#tabs .ui-state-active").attr("aria-controls");
	            var sprint_id = sprint_id_name.replace("sprint_", "");

	            var id_no = id.replace("li_tache_","");
	            var json_liste_tache = get_all_liste_tache(sprint_id_name);
	          //  var url = "sprintactivite/rendreInactif/" + g_selected_projet_id+ "/"+ sprint_id + "/" + json_liste_tache;
console.log(json_liste_tache);
	            var url = "sprintactivite/rendreInactif";
	            $.ajax({ statusCode: {
	            500: function(xhr) {
	             alert(500);
	            }},
	            //the route pointing to the post function
	            url: url,
	            data:{"projet_id" : g_selected_projet_id, "sprint_id" : sprint_id, "json" : json_liste_tache },
	            type: 'PUT',

	        success: function (result,status,xhr) {

	              $('#' + id).remove();

	        },error(xhr,status,error){
	            alert("error 1 " + status);
	            alert("error 2 " + error);
	        },
	            complete: function (xhr,status) {
	                // Handle the complete event
	             //alert("complete " + status);
	            }
	        });
	    }

	}); // $("body").delegate('a.x-remove','click',function()



  
    $("body").delegate('a.c-comment','click',function(e) {
        /**********************************************************
            C'est le click de l'icone commentaire sur les taches...
            on load les commentaires associés a une taches
        ***********************************************************/
        e.preventDefault();
        
        var tache_nom = $(this).parent().attr("id");
        var tache_id = tache_nom.replace("li_tache_", "");
        var obj_commentaire;
        var json_commentaires = get_commentaire(g_selected_projet_id, tache_id);



        if(json_commentaires != ""){

            obj_commentaire = JSON.parse(json_commentaires);    
        }
        
        afficher_commentaire(obj_commentaire, g_selected_projet_id, tache_id);


        $.blockUI({
            theme:false,
            message: $('#tache_commentaire'),
            css: { textAlign:'left',overflow:'auto',top:'10%',left:'10%',width:'80%',height:'90%', cursor: 'default' }
        });
        


    }); //$("body").delegate('a.c-comment','click',function()


    
    $("body").delegate('a.i-info','click',function(e) {

        e.preventDefault();

        var t_no = $(this).parent().attr("id").replace("li_tache_", "");
        var url = "/taches/" + t_no;
        $.ajax({ statusCode: {
                500: function(xhr) {
                 alert(500);
                }},
                //the route pointing to the post function
                url: url,
                type: 'get',
                dataType: 'text',
                // remind that 'data' is the response of the AjaxController
            success: function (result,status,xhr) {
                if(!$.isEmptyObject(result)){
                  var res =  JSON.parse(result)[0];
                  var t = "<span class='glyphicon glyphicon-remove pull-right' style='color:#BBB;'></span>";
                  t += "<table class='table table_info'>";
                  t += "<caption>" + res.tache_nom + "</caption>";
                  t += "<tr><td>Creer par</td><td>" + res.creer_par + "</td></tr>";
                  //t += "<tr><td>Telephone</td><td>" + res.telephone + "</td></tr>";
                  t += "<tr><td>Courriel</td><td>" + res.courriel + "</td></tr>";
                  t += "<tr><td>Date Création</td><td>" + res.tache_creer_date + "</td></tr>";
                  t += "<tr><td>Date Modification</td><td>" + res.tache_maj_date + "</td></tr>";
                  t += "<tr><td>Description</td><td>" +  res.tache_description + "</td></tr>";
                  t += "</table>";


                  $('#tache_info').html(t);
                }else{
                  $('#tache_info').html("<p>Aucune information</p>");
                }

                 // alert( result);
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

      
       $.blockUI({

            message: $('#tache_info'),
            css: { top:'20%',  cursor: 'default'},
            textAlign: 'left'
        });

    }); //$("body").delegate('a.i-info','click',function()





}); //$(document).ready(function