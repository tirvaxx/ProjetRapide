	function commentaire_head(photo, commentaire_id){
		var s =  '<div class="media" commentaire_id="' + commentaire_id + '">';
		    s += '	<div class="media-left">';
            s += '		<img src="images/'+ photo + '" class="media-object" style="width:45px">';
            s += '	</div>';

        return s;
	}

	function commentaire_body(acteur_nom, date_creer, commentaire){
		var s = '<div class="media-body">';
            s += '	<h4 class="media-heading">' + acteur_nom + '<small><i> Publié le ' + date_creer + '</i></small></h4>';
            s += '	<p class="commentaire">'+ commentaire + '</p>';
          

            
        return s;
	}


	function commentaire_footer(){
		var s =  '	</div>';
            s += '</div>';
        return s;
	}



function get_commentaire(projet_id, tache_id){

		var commentaires = "";
		var url = "/commentaires/" + projet_id + "/" + tache_id;
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



              

	function afficher_commentaire(res, projet_id, tache_id){

		var html_commentaire;
        var prev_id = -1;
        

        
        var obj = $('#tache_commentaire > .container');
        
        $(obj).html("<h2>Commentaires</h2>");
        $(obj).append('<input type="hidden" id="info_projet"  projet_id="' + projet_id + '" tache_id="' + tache_id + '"></input>');



        if(!jQuery.isEmptyObject(res)){

            html_commentaire = "";
            $.each(res, function(i, obj_json) {

                html_commentaire += commentaire_head(obj_json.photo,obj_json.id);
                html_commentaire += commentaire_body(obj_json.nom_employe, obj_json.date_creation, obj_json.commentaire);    
                html_commentaire += commentaire_footer();

            });
        
        }else{
        	html_commentaire = "<p>Aucun commentaire.</p>"
        }

        $(obj).append(html_commentaire);
        
        var s = '  <div  class="form_commentaire form-group col-xs-8">';
        s += '      <form>';
        s += '          <textarea  class="form-control input-group-lg" placeholder="Commentaire"></textarea>';
        s += '          <button id="btn_commentaire" class="btn btn-default">Envoyer</button>';
        s += '      </form>';
        s += '  </div>';
        $(obj).append(s);
	}

/*
	function commentaire_vide(projet_id, commentaire_id){
		var s =  '<div class="media"  commentaire_id="' + commentaire_id + '">';
		  //  s += '	<div class="media-left">';
          //  s += '		<img src="images/'+ photo + '" class="media-object" style="width:45px">';
          //  s += '	</div>';
 			s += '		<div class="media-body">';
 			s += '			<h4 class="media-heading">Aucun commentaire</h4>';
          //  s += '			<h4 class="media-heading">' + acteur_nom + '<small><i> Publié le ' + date_creer + '</i></small></h4>';
          //  s += '			<p class="commentaire">'+ commentaire + '</p>';
          //  s += '  		<a href="#"  class="repondre btn pull-left">répondre</a>';
            s += '			<div  class="form_commentaire form-group col-xs-8" >';
            s += '				<form>';
            s += '					<textarea  class="form-control input-group-lg" placeholder="Commentaire"></textarea>';
            s += '					<button id="btn_commentaire" class="btn btn-default">Envoyer</button>';
            s += '				</form>';
            s += '			</div>';
            s += '		</div>';
            s += '</div>';
        return s;
	}
*/
$(document).ready(function() {




  
            
           
	
	$("body").delegate('a.repondre','click',function(e) {
      
        e.preventDefault();
        $(this).next(".form_commentaire").toggle();
		
	}); //$("body").delegate('a.repondre','click',function

	


	/*********************************************************
		Bouton enregistrer le commentaire
	**********************************************************/
	$("body").delegate("#btn_commentaire", "click", function(){

		
			var projet_obj = $("#info_projet");
		
			var projet_id;
			var tache_id;
			var commentaire;
			
			projet_id = $(projet_obj).attr("projet_id");  	
			tache_id = $(projet_obj).attr("tache_id");  
			commentaire = $(this).prev("textarea").val();	
			

				var data = 'projet_id=' + projet_id + '&tache_id=' + tache_id + '&commentaire=' + commentaire; 
				$.ajax({ statusCode: {
		                500: function(xhr) {
		                 alert(500);
		                }},
		                url: "/commentaires",
		                type: 'post',
		                data: data,
		                dataType: 'text',
		            success: function (result,status,xhr) {
		          
		            	//on réaffiche les commentaires incluant le nouveau commentaire
						var obj_commentaire;
				        var json_commentaires = get_commentaire(projet_id, tache_id);


				        if(json_commentaires != ""){
				            obj_commentaire = JSON.parse(json_commentaires);    
				        }
				        
				        afficher_commentaire(obj_commentaire, projet_id, tache_id);
		            },
		            error(xhr,status,error){
		                alert("error 1 " + status);
		                alert("error 2 " + error);
		            },
		            complete: function (xhr,status) {
						
				       


		            }
		       	}); //ajax


	}); //$("body").delegate("#btn_commentaire", "click", function



	




}); //$(document).ready(function()