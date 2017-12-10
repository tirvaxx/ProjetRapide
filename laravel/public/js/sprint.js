


function sur_double_clique_sprint(sprint_id){

			$('#sprint_message_modifier').hide();

      //on s'assure qu'on a bien cliqué sur la partie liste sinon exit
      if(!(typeof sprint_id != 'undefined' && sprint_id.indexOf("sprint_") >= 0)){
              return;
      }
      var sprint_no = sprint_id.replace("sprint_", "");

      $("#modifier_sprint_id").val(sprint_no);
      $url = "sprints/" + sprint_no + "/edit";

      $.ajax({ statusCode: {
          500: function(xhr) {
          alert(500);
          }},
          //the route pointing to the post function
          url: $url,
          type: 'GET',
          dataType: 'text',

      success: function (result,status,xhr) {
          var le_sprint = JSON.parse(result);
          $('#modifier_no_sprint').val(le_sprint.no_sprint);
					//alert("date_debut:"+ le_sprint.date_debut); // TODO : ici, je n'arrive pas à remettre les dates dans le form
					//var date_deb = Date.parse(le_sprint.date_debut, "yy-MM-dd");
					//$("#sprint_modifier_date_debut").val(date_deb);
          $('#sprint_modifier_date_debut').val(le_sprint.date_debut);
					$('#sprint_modifier_date_fin').val(le_sprint.date_fin);

					$('#modifier_ancien_sprint_no').val(le_sprint.no_sprint);
          $('#sprint_message_modifier').hide();

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
            message: $('#sprint_modifier_form'),
            css: { top:'20%'}
      });
}

$(document).ready(function(){

	// Sur double clique d'un élément li on va chercher aria-controls
	$("body").delegate('li','dblclick',function(){return sur_double_clique_sprint($(this).attr('aria-controls'))});



	// Sur Annuler du formulaire de modification d'un sprint
	$("body").delegate('#btn_sprint_formmodifier_annuler','click',function(){

	    $.unblockUI();
	    return false;
	});

	// Sur appuie du bouton modifier du formulaire de modification d'un sprint
 	$("body").delegate('#btn_sprint_modifier','click',function(){


 	    var id_sprint = $("#modifier_sprint_id").val();
			var ancien_sprint_no = $("#modifier_ancien_sprint_no").val();
 	    var input_name = "modifier_no_sprint";
 	    var no_sprint = $("#form_modifier_sprint :input[name='"+input_name+"']").val();
 	    var input_name = "sprint_modifier_date_debut";
 	    var date_debut_sprint = $("#form_modifier_sprint :input[name='"+input_name+"']").val();
			var input_name = "sprint_modifier_date_fin";
			var date_fin_sprint = $("#form_modifier_sprint :input[name='"+input_name+"']").val();

 	    var champs_valides = valider_champs_sprint(no_sprint, date_debut_sprint, date_fin_sprint, "#sprint_message_modifier");
 	    // Si les champs ne sont pas valides, on ne continue pas le processus de modification.
 	    if(!champs_valides)
 	      return;

 	    if(!modifier_sprint_bd(id_sprint, no_sprint, date_debut_sprint, date_fin_sprint))
 	      return;

 	    $.unblockUI();

 	});//#btn_liste_modifier
 	// Fin modifier une liste

	// Permet de modifier le sprint dans la bd
	function modifier_sprint_bd(id_sprint, no_sprint, date_debut, date_fin){
		//alert("sprint:"+id_sprint+' '+no_sprint+' '+ date_debut+' '+date_fin);
		$url = "sprints/" + id_sprint;

		$.ajax({ statusCode: {
		  500: function(xhr) {
		  alert(500);
		}},
		  //the route pointing to the post function
		  url: $url,
		  type: 'PUT', //UPDATE
		  // send the csrf-token and the input to the controller
		  data: $('#form_modifier_sprint').serialize(),
		  dataType: 'text',
		  // remind that 'data' is the response of the AjaxController
		success: function (result,status,xhr) {

		  //alert("result, status, xhr"+ result + ','+status+','+xhr);
		   //xhr{"success":"false","errors":"Controller : Les valeurs entr\u00e9es ne sont pas conformes aux valeurs attentues."},success,[object Object]
		  var json_rep = JSON.parse(xhr.responseText);

		  if(json_rep.status != null && json_rep.status == "error"){
		    $erreur = json_rep.message == null? "Une valeur entrée n'est pas conforme." : json_rep.message;
		    $("#sprint_message_modifier").html($erreur).removeClass().addClass("alert alert-warning").show();
		    return false;
		  }
		  else {
				$("#sprint_message_modifier").hide();
		    afficher_sprint_modifie(id_sprint, no_sprint, $("#modifier_ancien_sprint_no").val());
				toastr.success('Sprint Modifié', 'SUCCÈS!');
			  //$("#sprint_message").html("Modification de la liste réussie avec succès.").removeClass().addClass("alert alert-success").show().fadeOut(8000);
		  }

		  $.unblockUI();
		  return true;

		},error(xhr,status,error){
		    //$("#sprint_message").html("Une erreur est survenue lors de la modification de la liste.").removeClass().addClass("alert alert-danger").show().fadeOut(8000);
				toastr.error('Une erreur est survenue lors de la modification du sprint.', 'ERREUR!');
				return true;
		    //$.unblockUI();
		},
		  complete: function (xhr,status) {
		  // Handle the complete event
		  //alert("complete " + status);
		  }
		});
	}

	$('#btn_sprint_fermer').click(function() {
	    //permet d'effacer les valeurs du form et recommencer à neuf
	    $('#form_sprint')[0].reset();
	    $.unblockUI();
	    return false;
	}); //$('#btn_liste_fermer').click(function()


	 $(document).on("click", "#creer_item_sprint", function() {
	    //permet d'effacer les valeurs du form et recommencer à neuf
	    $('#form_sprint')[0].reset();
	    $.blockUI({
	        message: $('.div_sprint_form'),
	        css: { top:'20%'}
	    });

	}); //$(document).on("click", "#creer_item_sprint", function() {



	$('#btn_sprint_ajouter').click(function() {
		var input_name = "no_sprint";
		var no_sprint = $("#form_sprint :input[name='"+input_name+"']").val();
		var input_name = "date_debut";
		var date_debut = $("#form_sprint :input[name='"+input_name+"']").val();
		var input_name = "date_fin";
		var date_fin = $("#form_sprint :input[name='"+input_name+"']").val();

		var champs_valides = valider_champs_sprint(no_sprint, date_debut, date_fin, "#sprint_message_ajouter");
		//alert('valide:'+champs_valides);
		// Si les champs ne sont pas valides, on ne continue pas le processus d'ajout'.
		if(!champs_valides)
			return false;

	    $.ajax({

	            url: '/sprints',
	            type: 'POST',
	            data: $('#form_sprint').serialize() + "&projet_id=" + g_selected_projet_id,
	            dataType: 'text',

	        success: function (result,status,xhr) {

				if(!(xhr.responseText.indexOf("erreur") > 0 || xhr.responseText.indexOf("Erreur") > 0)){
					var json_rep = JSON.parse(xhr.responseText);

					if(json_rep.status != null && json_rep.status == "error"){
						$erreur = json_rep.message == null? "Une valeur entrée n'est pas conforme." : json_rep.message;
						$("#sprint_message_ajouter").html($erreur).removeClass().addClass("alert alert-warning").show();
						return false;
					}
					else {
						var id = JSON.parse(result).last_inserted_id;
						var numero = JSON.parse(result).numero;
						var sprint_retard = JSON.parse(result).sprint_retard;
						sprint_add_tab(id, numero, sprint_retard);
						$("#sprint_message_ajouter").hide();
						toastr.success('Sprint Ajouté', 'SUCCÈS!');
					}

				}else{
					toastr.error("Une erreur est survenue.", "Erreur!");
				}	
			} //success
	    }); //ajax

	}); // $('#btn_sprint_ajouter').click(function()

	// Permet de valider les champs d'un sprint
	function valider_champs_sprint(no_sprint, date_debut, date_fin, tag_msg){
		$(tag_msg).html("").hide();

		if(no_sprint.trim() == '' ||
		no_sprint.trim() == '0' ||
		no_sprint.trim() == '00' ||
		no_sprint.trim() == '000'){
			$(tag_msg).html("Le numéro de sprint ne doit pas être vide ou 0.").removeClass().addClass("alert alert-warning").show();
			return false;
		}

		var ExpNoSprint = /^[0-9]{1,3}$/;

		var res_test_no_sprint = no_sprint.match(ExpNoSprint);
		if(!res_test_no_sprint){
			$(tag_msg).html("Le numéro de sprint doit être entre 1 et 999.").removeClass().addClass("alert alert-warning").show();
			return false;
		}

		var date_deb = Date.parse(date_debut, "yy-MM-dd");
		if(!date_deb){
			$(tag_msg).html("La date de début n'est pas conforme selon une date.").removeClass().addClass("alert alert-warning").show();
			return false;
		}
		var date_f = Date.parse(date_fin, "yy-MM-dd");
		if(!date_f){
			$(tag_msg).html("La date de fin n'est pas conforme selon une date.").removeClass().addClass("alert alert-warning").show();
			return false;
		}

		/* TODO : incapable pour l'instant de faire cette vérification var now = new Date();
		if(new Date(date_debut).getTime() < now.getTime()){
			$("#sprint_message_ajouter").html("").hide();
			$("#sprint_message_ajouter").html("La date de début doit être plus grande que la date du jour.").removeClass().addClass("alert alert-warning").show();
			return false;
		}*/

		if(new Date(date_debut).getTime() > new Date(date_fin).getTime()){
			$("#sprint_message_ajouter").html("La date de début ne doit pas être plus grande que la date de fin.").removeClass().addClass("alert alert-warning").show();
			return false;
		}

		return true;

	}// valider_champs_sprint

	// Permet d'afficher la modification du numéro du sprint
	function afficher_sprint_modifie(id_sprint, no_sprint, no_sprint_ancien){

		//e.preventDefault();
		//e.stopImmediatePropagation();

		//g_selected_projet_id = id_projet;
		//var titre = $(this).attr("projet_nom");
		//$("#titre_projet").html(titre);
		//$("#projet_wrapper").hide();
		//$("#center-wrapper").show();

		$("#div_menu_commentaire_projet").show();


		$.ajax({

						url: "/home/" + g_selected_projet_id,
						type: 'GET',
						dataType: 'text',

				success: function (result,status,xhr) {


						 var json_obj = JSON.parse(result);
						 var prev_sprint;
						 var prev_liste;

					 //alert(j[0].projet_nom);

					 // Enlever les tabs présents pour ensuite les remettre
					 for (var i in json_obj)
					 {
						 if(json_obj[i].sprint_id == id_sprint)
						 		sprint_modifier_tab(json_obj[i].sprint_id, json_obj[i].sprint_numero);
					 }

					/*for (var i in json_obj)
					{

						if(prev_sprint != json_obj[i].sprint_id){


								sprint_add_tab(json_obj[i].sprint_id, json_obj[i].sprint_numero);

								$( "#tabs" ).tabs({ active: i });
								$( "#tabs" ).tabs( "refresh" );
						}*/

						/*if(json_obj[i].liste_id != null && prev_liste != json_obj[i].liste_id){
								creer_liste("sprint_" + json_obj[i].sprint_id, json_obj[i].liste_id, json_obj[i].liste_nom, json_obj[i].liste_description);
						}*/

						/*if(json_obj[i].tache_nom != null){
								creer_tache( json_obj[i].liste_id,  json_obj[i].tache_id,  json_obj[i].tache_nom,  json_obj[i].tache_description,  json_obj[i].tache_retard);
						}*/
						/*prev_liste = json_obj[i].liste_id
						prev_sprint = json_obj[i].sprint_id;*/
					//}


						if(! jQuery.isEmptyObject(json_obj) ){
								 $( "#tabs" ).tabs({ active: 0 })
						}
			},
				error(xhr,status,error){
						//alert("error 1 " + status);
						//alert("error 2 " + error);
						toastr.error("Une erreur est survenue lors de l'affichage de la modification du sprint.", 'ERREUR!');
						return true;
				}

		});
	}








}); //$(document).ready(function
