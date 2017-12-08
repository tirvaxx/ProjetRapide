var g_selected_projet_id;             
$(document).ready(function(){

	$(document).on("click", "#creer_item_projet", function() {
	      //permet d'effacer les valeurs du form et recommencer à neuf
	      $('#form_projet')[0].reset();
	      $.blockUI({
	            message: $('.div_projet_form'),
	            css: { top:'20%'}
	      });

    }); // $(document).on("click", "#creer_item_projet", function()


		$("body").delegate('#btn_projet_charger','click', function() {


                var p_id = $(this).attr("projet_id");
                g_selected_projet_id = p_id;
                var titre = $(this).attr("projet_nom");
                $("#titre_projet").html(titre);
                $("#projet_wrapper").hide();
                $("#center-wrapper").show();



                $.ajax({

                        url: "/home/" + p_id,
                        type: 'GET',
                        dataType: 'text',

                    success: function (result,status,xhr) {

                      //   alert(result);
                         var json_obj = JSON.parse(result);
                         var prev_sprint;
                         var prev_liste;
                       //alert(j[0].projet_nom);
                      for (var i in json_obj)
                    {

                        if(prev_sprint != json_obj[i].sprint_id){
                            sprint_add_tab(json_obj[i].sprint_id, json_obj[i].sprint_numero);

                            $( "#tabs" ).tabs({ active: i });
                            $( "#tabs" ).tabs( "refresh" );
                        }

                        if(json_obj[i].liste_id != null && prev_liste != json_obj[i].liste_id){
                            creer_liste("sprint_" + json_obj[i].sprint_id, json_obj[i].liste_id, json_obj[i].liste_nom, json_obj[i].liste_description);
                        }

                        if(json_obj[i].tache_nom != null){
                            creer_tache( json_obj[i].liste_id,  json_obj[i].tache_id,  json_obj[i].tache_nom,  json_obj[i].tache_description);
                        }
                        prev_liste = json_obj[i].liste_id
                        prev_sprint = json_obj[i].sprint_id;

                    }


                        if(! jQuery.isEmptyObject(json_obj) ){
                             $( "#tabs" ).tabs({ active: 0 })
                        }
         			},
                    error(xhr,status,error){
                        alert("error 1 " + status);
                        alert("error 2 " + error);
                    }

                });


            }); //$("body").delegate('#btn_projet_charger','click', function

            $("body").delegate('#btn_projet_modifier','click', function() {

                var p_id = $(this).attr("projet_id");
                g_selected_projet_id = p_id;

                var titre = $(this).attr("projet_nom");
                //$("#titre_projet").html(titre);
                //$("#projet_wrapper").hide();
                //$("#center-wrapper").show();

                $("body").data("modif_projet_no", p_id);
                $url = "projets/" + p_id + "/edit";

                $.ajax({ statusCode: {
                    500: function(xhr) {
                    alert(500);
                    }},
                    //the route pointing to the post function
                    url: $url,
                    type: 'GET',
                    dataType: 'text',

                success: function (result,status,xhr) {
                    var le_projet = JSON.parse(result);
                    //alert("resultat : "+ result);
                    $('#modifier_nom_projet').val(le_projet.projet_nom);
                    $('#modifier_description_projet').val(le_projet.projet_description);
                    $('#modifier_date_du_projet').val(le_projet.projet_date_du);
                    if(le_projet.projet_date_complete != null)
                      $('#modifier_date_complete_projet').val(le_projet.projet_date_complete);
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
                     message: $('#projet_modifier_form'),
                     css: { top:'20%'}
                });


            }); // btn_projet_modifier click

            $("body").delegate('#btn_projet_formmodifier','click',function(){

                $projet_no = $("body").data("modif_projet_no");

                var input_name = "modifier_nom_projet";
                var nom_projet = $("#form_modifier_projet :input[name='"+input_name+"']").val();
                var input_name = "modifier_description_projet";
                var description_liste = $("#form_modifier_projet :input[name='"+input_name+"']").val();
                var input_name = "modifier_date_du_projet";
                var description_liste = $("#form_modifier_projet :input[name='"+input_name+"']").val();
                var input_name = "modifier_date_complete_projet";
                var description_liste = $("#form_modifier_projet :input[name='"+input_name+"']").val();


                /*var lblMessageListeModifier = "liste_message_modifier"; // Permet d'afficher un message d'erreur dans le formulaire.

                var ExpNom = /^[0-9a-zA-Z\s\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿç  Ç_]{2,40}$/;
                var ExpDesc = /^[0-9a-zA-Z\s\r\n\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿçÇ_]{2,150}$/;
                var ExpDesc = /^[^;]{2,150}$/;

                var res_test_nom = nom_liste.match(ExpNom);
                var res_test_desc = description_liste.match(ExpDesc);

                if( nom_projet.replace(/\s/g, '') == "" ||
                    description_projet.replace(/\s/g, '') == "" || !res_test_nom || !res_test_desc){

                    $('#'+lblMessageListeModifier).html("<tr><td width=\"20%\" style=\"vertical-align : middle; font-size: 35px;text-align:center;\"><span>&#9888</span></td><td width=\"80%\" style=\"vertical-align : middle;\">" +
                    "<span><strong>Nom de la liste :</strong><br/>(2 à 40 caractères maximum acceptant les caratères : 0 à 9, a à z, A à Z, espace, point, àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿçÇ_)<br/><strong>Description de la liste :</strong><br/>(2 à 150 caractères).</span></td></tr>");
                    $('#'+lblMessageListeModifier).show();
                    message: $('#liste_modifier_form')
                    return;
                }*/

                $url = "projets/" + $projet_no;

                $.ajax({ statusCode: {
                    500: function(xhr) {
                    alert(500);
                    }},
                    //the route pointing to the post function
                    url: $url,
                    type: 'PUT',
                    // send the csrf-token and the input to the controller
                    data: $('#form_modifier_projet').serialize(),
                    dataType: 'text',
                    // remind that 'data' is the response of the AjaxController
                    success: function (result,status,xhr) {
                      // on retourne au home pour voir les projets... en attendant todo a continuer
                      url = "/home";
                      $( location ).attr("href", url);

                    },error(xhr,status,error){
                        alert("error 1 " + status);
                        alert("error 2 " + error);
                    },
                    complete: function (xhr,status) {
                    // Handle the complete event
                    //alert("complete " + status);
                    }
                });
                $.unblockUI();

            });//#btn_projet_formmodifier click

            // Fin modifier une tâche
            // Modifier un projet
            $("body").delegate('#btn_projet_formmodifier_annuler','click',function(){
                //alert("annuler");
                $.unblockUI();
                //$("#center-wrapper").show();
                return false;
            });  // $("body").delegate('#btn_projet_formmodifier_annuler','click',function

			$('#btn_projet_fermer').click(function() {
                    //permet d'effacer les valeurs du form et recommencer à neuf
                    $('#form_projet')[0].reset();
                    $.unblockUI();
                    return false;
            }); //$('#btn_projet_fermer').click(function()


             $('#btn_projet_ajouter').click(function() {

                    var nom_projet = $("#nom_projet").val();
                    var description_projet = $("#description_projet").val();
                    var data =  $('#form_projet').serialize();

                    $.ajax({ statusCode: {
                        500: function(xhr) {
                         alert(500);
                        }},
                        //the route pointing to the post function
                        url: '/projets',
                        type: 'POST',
                        // send the csrf-token and the input to the controller
                        data: data,
                        dataType: 'text',
                        // remind that 'data' is the response of the AjaxController
                    success: function (result,status,xhr) {

                            // on retourne au home pour voir les projets... en attendant todo a continuer
                            url = "/home";
                            $( location ).attr("href", url);
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

                }); // $('#btn_projet_ajouter').click(function()

             //****************SEARCHBAR*******************
                //////////////////////////////////////////////


                $('#search-bar').autocomplete({
                    source : function(request, response){ // les deux arguments représentent les données nécessaires au plugin
                        $.ajax({
                            url : '/users',
                            type : 'POST', // on appelle le script JSON
                            data: {term: request.term},
                            dataType : 'json', // on spécifie bien que le type de données est en JSON
                            
                            success: function (data) {
                                console.log(data);
                                response($.map(data, function(item) {
                                    return {
                                        label : item.name
                                    } 
                                }));
                            }
                        });
                    },
                    
                });
                
                //****************END SEARCHBAR*******************
                //////////////////////////////////////////////

                $('#btn_assignation').click(function(e) {
                    e.preventDefault();

                    var nomProjet = $(this).parents().eq(3).attr("id");
                    console.log(nomProjet);
                    var idProjet = nomProjet.replace("collapse_", "");
                    console.log(idProjet);
                    var nomUser = document.getElementById("search-bar").value;
                    var data = $('#form_assignation').serialize() + "&projet_id=" + idProjet; 
                    $.ajax({
                        url : '/assignation',
                        type : 'POST',
                        data : data,
                        dataType : 'text',

                        success: function(result, status, xhr) {
                            toastr.success('Utilisateur ajouté au projet', 'SUCCESS!!');
                            //toastMessageSuccess(document.getElementById("search-bar").value);
                        },
                        error: function(xhr,status,error) {
                            alert("error 1 " + status);
                            alert("error 2 " + error);
                        }
                    });
                });


}); //$(document).ready(function
