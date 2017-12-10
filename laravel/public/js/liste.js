



function creer_liste(sprint_id_name,id, nom, description){

// var sprint_id_name = $('#tabs .ui-state-active').attr('aria-controls');
  //  alert(sprint_id_name);
//    var sprint_id = sprint_id_name.replace("sprint_", "");
  //  alert(sprint_id);

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

	$("#" + sprint_id_name).append($liste);

	$("#btn_ajouter_tache_Liste_" + id ).bind('click', function(e)
	{
	    e.preventDefault();
	    ajouter_tache();
	});



	$('.container-list .sortable-list').sortable({connectWith: '.container-list .sortable-list', placeholder: 'placeholder',
	    stop: function( event, ui ){

 	var tache_id_nom = ui.item.attr("id");






/*
	$("#" + tache_id_nom).animate({
	   borderLeftColor: "green",
	   borderTopColor: "green",
	   borderRightColor: "green",
	   borderBottomColor: "green",
	}, 0);


setTimeout(function(){

    var div = $("#" + tache_id_nom);
    $({alpha:1}).animate({alpha:0}, {
        duration: 1000,
        step: function(){
            div.css('border','thick solid rgba(0,255,0,'+this.alpha+')');
        }
    });

}, 0);


*/

 					var sprint_id_name = $("#tabs .ui-state-active").attr("aria-controls");
	        var sprint_id = sprint_id_name.replace("sprint_", "");

	        var json_liste_tache = get_all_liste_tache(sprint_id_name);

//console.log(json_liste_tache);


	        var data =  "projet_id=" + g_selected_projet_id+ "&sprint_id=" + sprint_id + "&liste_tache=" + json_liste_tache;



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

	        success: function (result,status,xhr) {
				toastr.success('Déplacement enregistré', 'SUCCES!');

       		},error(xhr,status,error){
				toastr.error('Déplacement non enregistré', 'Erreur!');

	        },
	            complete: function (xhr,status) {
	                // Handle the complete event
	             //alert("complete " + status);
	            }
	        });  //ajax

	    } // stop function


	}); //$('.container-list .sortable-list').sortable

} //creer_liste


function sur_double_clique_liste(liste_id){

      //var liste_id =  $(this).attr('id');
      //on s'assure qu'on a bien cliqué sur la partie liste sinon exit
      if(!(typeof liste_id != 'undefined' && liste_id.indexOf("liste_panel_") >= 0)){
              return;
      }
      var liste_no = liste_id.replace("liste_panel_", "");

      $("#modifier_liste_id").val(liste_no);
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
              //alert("error 1 " + status);
              //alert("error 2 " + error);
          },

          complete: function (xhr,status) {
          // Handle the complete event
          //alert("complete " + status);
          }
      });

      $.blockUI({
            message: $('#liste_modifier_form'),
            css: { top:'20%'}
      });
    }



function valider_champs_liste(nom_liste, description_liste, tag_msg){

	if( nom_liste.replace(/\s/g, '') == ""){
	$(tag_msg).html("Le nom de la liste ne doit pas être vide ou contenir seulement des espaces.").removeClass().addClass("alert alert-warning").show();
	return false;
	}

	if( description_liste.replace(/\s/g, '') == ""){
	$(tag_msg).html("La description de la liste ne doit pas être vide ou contenir seulement des espaces.").removeClass().addClass("alert alert-warning").show();
	return false;
	}

	var ExpNom = /^[0-9a-zA-Z\s\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿç  Ç_\']{2,50}$/;
	var ExpDesc = /^[^;]{2,200}$/;

	var res_test_nom = nom_liste.match(ExpNom);
	var res_test_desc = description_liste.match(ExpDesc);

	if(!res_test_nom){
		$(tag_msg).html("Le nom de la liste contient un caractère non accepté.").removeClass().addClass("alert alert-warning").show();
		return false;
	}
	if(!res_test_desc){
		$(tag_msg).html("La description de la liste contient un caractère non accepté ou ne respecte pas la longueur définie : 2 à 200 caractères.").removeClass().addClass("alert alert-warning").show();
		return false;
	}



	return true;

}// valider_champs_liste

// Permet d'afficher la modification du nom de la liste
function afficher_liste_modifiee(id_liste, nom_liste, description_liste){

	var tagAModifier = "liste_titre_"+id_liste;
	$('#'+tagAModifier).text(nom_liste);

	tagAModifier = "liste_panel_"+id_liste;
	$('#'+tagAModifier).attr('title', description_liste);
}

// Permet de modifier la liste dans la bd
function modifier_liste_bd(id_liste, nom_liste, description_liste){
	$url = "listes/" + id_liste;

	$.ajax({ statusCode: {
	  500: function(xhr) {
	  alert(500);
	}},
	  //the route pointing to the post function
	  url: $url,
	  type: 'PUT', //UPDATE
	  // send the csrf-token and the input to the controller
	  data: $('#form_modifier_liste').serialize(),
	  dataType: 'text',
	  // remind that 'data' is the response of the AjaxController
	success: function (result,status,xhr) {

	  //alert("result, status, xhr"+ result + ','+status+','+xhr);
	   //xhr{"success":"false","errors":"Controller : Les valeurs entr\u00e9es ne sont pas conformes aux valeurs attentues."},success,[object Object]
	  var json_rep = JSON.parse(xhr.responseText);

	  if(json_rep.status != null && json_rep.status == "error"){
	    $erreur = json_rep.message == null? "Une valeur entrée n'est pas conforme." : json_rep.message;
	    $("#liste_message_modifier").html($erreur).removeClass().addClass("alert alert-warning").show();
	    return false;
	  }
	  else {
	    afficher_liste_modifiee(id_liste, nom_liste, description_liste);
	    $("#liste_message_modifier").hide();
			toastr.success('Liste Modifiée', 'SUCCES!');
		  //$("#sprint_message").html("Modification de la liste réussie avec succès.").removeClass().addClass("alert alert-success").show().fadeOut(8000);
	  }

	  $.unblockUI();
	  return true;

	},error(xhr,status,error){
			toastr.error('Une erreur est survenue lors de la modification de la liste.', 'ERREUR!');
	    //$("#sprint_message").html("Une erreur est survenue lors de la modification de la liste.").removeClass().addClass("alert alert-danger").show().fadeOut(8000);
	    return true;
	    //$.unblockUI();
	},
	  complete: function (xhr,status) {
	  // Handle the complete event
	  //alert("complete " + status);
	  }
	});
}


$(document).ready(function(){



	// sur double-clique d'un div aller chercher la liste et l'afficher pour modification, sinon ne rien faire
	$("body").delegate('div','dblclick',function(){return sur_double_clique_liste($(this).attr('id'))});




	// Annuler la modification d'une liste
	$("body").delegate('#btn_liste_formmodifier_annuler','click',function(){
	    //$('#form_modifier_liste')[0].reset();
	    $.unblockUI();
	    return false;
	});

 // Sur appuie du bouton modifier de la liste
	$("body").delegate('#btn_liste_modifier','click',function(){


	    var id_liste = $("#modifier_liste_id").val();
	    var input_name = "modifier_nom_liste";
	    var nom_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val();
	    var input_name = "modifier_description_liste";
	    var description_liste = $("#form_modifier_liste :input[name='"+input_name+"']").val();

	    var champs_valides = valider_champs_liste(nom_liste, description_liste, "#liste_message_modifier");
	    // Si les champs ne sont pas valides, on ne continue pas le processus de modification.
	    if(!champs_valides)
	      return;

	    if(!modifier_liste_bd(id_liste, nom_liste, description_liste))
	      return;

	    $.unblockUI();

	});//#btn_liste_modifier
	// Fin modifier une liste



	$('#btn_liste_fermer').click(function() {
	    //permet d'effacer les valeurs du form et recommencer à neuf
	    $('#form_liste')[0].reset();

	    $.unblockUI();
	    return false;
	}); //$('#btn_liste_fermer').click(function()

	 $('#btn_liste_ajouter').click(function() {

		var sprint_id_name = $('#tabs .ui-state-active').attr('aria-controls');

		var sprint_id = sprint_id_name.replace("sprint_", "");

    var input_name = "nom_liste";
    var nom_liste = $("#form_liste :input[name='"+input_name+"']").val();
    var input_name = "description_liste";
    var description_liste = $("#form_liste :input[name='"+input_name+"']").val();

    var champs_valides = valider_champs_liste(nom_liste, description_liste, "#liste_message_ajouter");
    // Si les champs ne sont pas valides, on ne continue pas le processus de modification.
    if(!champs_valides)
      return;

		// alert(sprint_id);

		var data =  $('#form_liste').serialize() + "&projet_id=" + g_selected_projet_id+ "&sprint_id=" + sprint_id

		$.ajax({ statusCode: {
		    500: function(xhr) {
		     alert(500);
		    }},
		    //the route pointing to the post function
		    url: '/listes',
		    type: 'POST',
		    // send the csrf-token and the input to the controller
		    data: data,
		    dataType: 'text',
		    // remind that 'data' is the response of the AjaxController
		success: function (result,status,xhr) {

			var json_rep = JSON.parse(xhr.responseText);

			// Si erreur, on affiche l'erreur
			if(json_rep.status != null && json_rep.status == "error"){
				$erreur = json_rep.message == null? "Une valeur entrée n'est pas conforme." : json_rep.message;
				$("#liste_message_ajouter").html($erreur).removeClass().addClass("alert alert-warning").show();
				return false;
			}
			else { // Tout s'est bien passé, on crée la liste
				$("#liste_message_ajouter").hide();
				toastr.success('Liste Ajoutée', 'SUCCÈS!');

				var id = JSON.parse(result).last_inserted_id;
				var nom = JSON.parse(result).nom;
				var description = JSON.parse(result).description;
				creer_liste(sprint_id_name, id, nom, description);
			}

			$.unblockUI();
			return true;

		},
		error(xhr,status,error){
		    $("#liste_messag_ajouter").html("Une erreur est survenue lors de l'ajout de la liste.").removeClass().addClass("alert alert-danger").show().fadeOut(8000);
		    return true;
		    //$.unblockUI();
		},
		complete: function (xhr,status) {
		        // Handle the complete event

		     //alert("complete " + status);

		}
		});

	}); // $('#btn_liste_ajouter').click(function()

	$(document).on("click", "#creer_item_liste", function() {
		//permet d'effacer les valeurs du form et recommencer à neuf
		$('#form_liste')[0].reset();
		$('#liste_message_ajouter').hide();
		$.blockUI({
		    message: $('.div_liste_form'),
		    css: { top:'20%'}
		});


	}); // $(document).on("click", "#creer_item_liste", function()

}); //$(document).ready(function
