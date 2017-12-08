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


 //AddTab form: calls addTab function on submit and closes the dialog
	$('#btn_sprint_ajouter').click(function() {

	    $.ajax({

	            url: '/sprints',
	            type: 'POST',
	            data: $('#form_sprint').serialize() + "&projet_id=" + g_selected_projet_id,
	            dataType: 'text',

	        success: function (result,status,xhr) {

	                var id = JSON.parse(result).last_inserted_id;
	                var numero = JSON.parse(result).numero;

	                sprint_add_tab(id, numero);

	        },
	        error(xhr,status,error){
	            alert("error 1 " + status);
	            alert("error 2 " + error);
	        }

	    });
	}); // $('#btn_sprint_ajouter').click(function()











}); //$(document).ready(function