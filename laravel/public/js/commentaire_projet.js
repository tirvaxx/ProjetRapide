	function commentaire_projet_head(photo, commentaire_id){
		var s =  '<div class="media" commentaire_id="' + commentaire_id + '">';
		    s += '	<div class="media-left">';
            s += '		<img src="images/'+ photo + '" class="media-object" style="width:45px">';
            s += '	</div>';

        return s;
	}

	function commentaire_projet_body(acteur_nom, date_creer, commentaire){
		var s = '<div class="media-body">';
            s += '	<h4 class="media-heading">' + acteur_nom + '<small><i> Publié le ' + date_creer + '</i></small></h4>';
            s += '	<p class="commentaire">'+ commentaire + '</p>';
          

            
        return s;
	}


	function commentaire_projet_footer(){
		var s =  '	</div>';
            s += '</div>';
        return s;
	}



function get_commentaire_projet(projet_id){

		var commentaires = "";
		var url = "/commentaires_projet/" + projet_id;
        $.ajax({ statusCode: {
                500: function(xhr) {
                 alert(500);
                }},
                async: false,
                url: url,
                type: 'get',
                dataType: 'text',
            success: function (result,status,xhr) {

 				commentaires = result;
            },
            error(xhr,status,error){
                alert("error 1 " + status);
                alert("error 2 " + error);
            },
            complete: function (xhr,status) {
                   
 				
                

            }
        });


     	return commentaires;

	}



              

	function afficher_commentaire_projet(res, projet_id){

		var html_commentaire;
        var prev_id = -1;
        

        
        var obj = $('#commentaire_projet');
        
     
        $(obj).html("");
    	



        if(!jQuery.isEmptyObject(res)){

            html_commentaire = "";
            $.each(res, function(i, obj_json) {

                html_commentaire += commentaire_projet_head(obj_json.photo,obj_json.id);
                html_commentaire += commentaire_projet_body(obj_json.nom_employe, obj_json.date_creation, obj_json.commentaire);    
                html_commentaire += commentaire_projet_footer();

            });
        
        }else{
        	html_commentaire = "<p>Aucun commentaire.</p>"
        }

        $(obj).append(html_commentaire);
 
        
	} //afficher_commentaire_projet

$(document).ready(function() {


	/*********************************************************
		Bouton enregistrer le commentaire
	**********************************************************/
	$("body").delegate("#btn_commentaire_projet", "click", function(e){

		
			e.preventDefault();
			var projet_id = g_selected_projet_id;
			var commentaire;
			
			commentaire = $(this).prev("textarea").val();	
			

			var data = 'projet_id=' + projet_id + '&commentaire=' + commentaire; 
			$.ajax({ statusCode: {
	                500: function(xhr) {
	                 alert(500);
	                }},
	                url: "/commentaires_projet",
	                type: 'post',
	                data: data,
	                dataType: 'text',
	            success: function (result,status,xhr) {
	          
	            	//on réaffiche les commentaires incluant le nouveau commentaire
					var obj_commentaire;
			        var json_commentaires = get_commentaire_projet(projet_id);


			        if(json_commentaires != ""){
			            obj_commentaire = JSON.parse(json_commentaires);    
			        }
			        
			        afficher_commentaire_projet(obj_commentaire, projet_id);
	            },
	            error(xhr,status,error){
	                alert("error 1 " + status);
	                alert("error 2 " + error);
	            },
	            complete: function (xhr,status) {
					
			       


	            }
	       	}); //ajax


	}); //$("body").delegate("#btn_commentaire", "click", function


   $("#btn_menu_commentaire_projet").click(function(e){


 		/**********************************************************
            C'est le click de de l'icone commentaire dans le menu
            on load les commentaires associés au projet
        ***********************************************************/
        e.preventDefault();
                
        var obj_commentaire;
        var json_commentaires = get_commentaire_projet(g_selected_projet_id);

		$("#form_commentaire_projet")[0].reset();

        if(json_commentaires != ""){

            obj_commentaire = JSON.parse(json_commentaires);    
        }
        
        afficher_commentaire_projet(obj_commentaire, g_selected_projet_id);


   });
	




}); //$(document).ready(function()