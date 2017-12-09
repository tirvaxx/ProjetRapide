$(document).ready(function(){



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

									var json_rep = JSON.parse(xhr.responseText);

								  if(json_rep.status != null && json_rep.status == "error"){
								    $erreur = json_rep.message == null? "Une valeur entrée n'est pas conforme." : json_rep.message;
								    $("#sprint_message_ajouter").html($erreur).removeClass().addClass("alert alert-warning").show();
								    return false;
								  }
								  else {
										var id = JSON.parse(result).last_inserted_id;
		                var numero = JSON.parse(result).numero;

		                sprint_add_tab(id, numero);
								    $("#sprint_message_ajouter").hide();
										toastr.success('Sprint Ajouté', 'SUCCÈS!');
								  }
						}
	    });
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








}); //$(document).ready(function
