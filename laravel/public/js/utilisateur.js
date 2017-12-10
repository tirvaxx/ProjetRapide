/****************** Partie UTILISATEURS ******************/
function creer_utilisateur(nom_actif, utilisateur_id, utilisateur_nom){
     $("#ul_liste_utilisateurs_" + nom_actif).append( '<li id="li_utilisateur_' + utilisateur_id + '" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span><a href="#" class="i-info"><span class="glyphicon glyphicon-info-sign pull-left"></a><span id="utilisateur_nom_'+ utilisateur_id + '">' + utilisateur_nom + '</span></li>' );

}
// Permet d'afficher une liste d'utilisateurs afin de gérer les utilisateurs
function afficher_liste_utilisateurs(actif){

    $nom_actif = "actifs";
    $nom_inactif = "inactifs";

   $liste = '<div class="container-list-utilisateur">';
   $liste +='    <div class="panel panel-default column left"  id="liste_utilisateurs_' + $nom_actif +'_' + '">';
   $liste +='        <div class="panel-heading" id="liste_panel_utilisateurs_' + $nom_actif +'_' +'" rel="tooltip" title="Utilisateurs inactifs dans le système.">';
   $liste +='            <span id="liste_titre_utilisateurs_' + $nom_actif + '">Utilisateurs ' + $nom_actif + '</span>';
   $liste +='        </div>  <!-- panel-heading -->';
   $liste +='        <div class="panel-body">';
   $liste +='            <ul class="sortable-list" id="ul_liste_utilisateurs_' + $nom_actif +'_' + '">';
   $liste +='            </ul>';
   $liste +='        </div> <!-- panel-body -->';
   $liste +='        <div class="panel-footer">';
   $liste +='            <a href="#" id="btn_ajouter_utilisateur_Liste_actifs" class="btn btn-link right">ajouter un utilisateur</a>';
   $liste +='        </div> <!-- panel-footer -->';
   $liste +='    </div>  <!-- panel-default -->';
   $liste +='</div>  <!-- #container-liste -->';

   $liste += '<div class="container-list-utilisateur">';
   $liste +='    <div class="panel panel-default column left"  id="liste_utilisateurs_' + $nom_inactif +'_' + '">';
   $liste +='        <div class="panel-heading" id="liste_panel_utilisateurs_' + $nom_inactif +'_' +'" rel="tooltip" title="Utilisateurs inactifs dans le système.">';
   $liste +='            <span id="liste_titre_utilisateurs_' + $nom_inactif + '">Utilisateurs ' + $nom_inactif + '</span>';
   $liste +='        </div>  <!-- panel-heading -->';
   $liste +='        <div class="panel-body">';
   $liste +='            <ul class="sortable-list" id="ul_liste_utilisateurs_' + $nom_inactif +'_' + '">';
   $liste +='            </ul>';
   $liste +='        </div> <!-- panel-body -->';
   $liste +='        <div class="panel-footer">';
   $liste +='        </div> <!-- panel-footer -->';
   $liste +='    </div>  <!-- panel-default -->';
   $liste +='</div>  <!-- #container-liste -->';

   //$("#form_gerer_utilisateurs").append($liste);

   $( ".utilisateurs_form_ajouter_listes" ).html($liste);

   $("#btn_ajouter_utilisateur_Liste_actifs" ).bind('click', function(e)
   {
       e.preventDefault();
       ajouter_utilisateur();
   });


   //var json_liste_utilisateur = get_all_liste_utilisateur(actif);
   //var sprint_id_name = $("#tabs .ui-tabs-panel:visible").attr("id");

   $.ajax({ statusCode: {
       500: function(xhr) {
        alert(500);
       }},
       //the route pointing to the post function
       url: "/acteurs" ,
       type: 'GET',
       dataType: 'text',

   success: function (data, hrx, obj) {
     alert("bonjour a tous data:" +data+ " hrx : "+hrx+" ex: "+obj);
           $(hrx).each(function(){
             // will loop through
             alert("Trouve un nom: " + $(this).attr("nom"));
          });

     //alert('allo '+ liste_uti[0]);

     //jQuery.each(data, function (index, value) {
      // alert('elementAT '+index+' : '+value);
       // need to create divs with *icon and *title from data
       //creer_utilisateur($nom_actif, utilisateur_id, utilisateur_nom)
       //console.log(index + ' ' + value);
     //});
   },error(xhr,status,error){
       alert("error 1 " + status);
       alert("error 2 " + error);
   },
       complete: function (xhr,status) {
           // Handle the complete event
        //alert("complete " + status);
       }
   });  //ajax

} //creer_liste

function ajouter_utilisateur(){
    $("#utilisateur_message_ajouter").hide();
    $('#ajouter_utilisateur_type_1_et_type_2').show();
    $('#form_utilisateur')[0].reset();
    $.blockUI({
        message: $('.div_ajouter_utilisateur_form'),
        css: { top:'20%'}
    });
} //ajouter_utilisateur

// Sur fermer la fenêtre gérer utilisateurs
$("body").delegate('#btn_utilisateurs_fermer','click',function(){
    $.unblockUI();
    return false;
});

// Sur fermer la fenêtre ajouter utilisateur
$("body").delegate('#btn_utilisateur_ajouter_fermer','click',function(){
    $.unblockUI();
    return false;
});

/// pour redimensionner :
// $.blockUI({
//            theme:false,
//            message: $('#tache_commentaire'),
//            css: { textAlign:'left',overflow:'auto',top:'10%',left:'10%',width:'80%',height:'90%', cursor: 'default' }
//        });
// Lorsqu'on clique sur un item du menu
$("body").delegate('#selection_type_utilisateur', 'change', onSelectChangeTypeUtilisateur);

function onSelectChangeTypeUtilisateur(){
    var id_type = 0,
        $this = $(this);

    if($this.val() != 0){
        id_type = $this.find('option:selected').val();
    }

    // Si de type 1 et 2 afficher la partie Gestionnaire et utilisateur
    if(id_type == 1 || id_type == 2){
      $('#ajouter_utilisateur_type_3').hide();
      $('#ajouter_utilisateur_type_1_et_type_2').show();
    }
    else { // Afficher la partie 3 client
      $('#ajouter_utilisateur_type_1_et_type_2').hide();
      $('#ajouter_utilisateur_type_3').show();
    }
}



$(document).ready(function(){

  // Ouvre un formulaire pour gérer les utilisateurs
$(document).on("click", "#gerer_utilisateurs", function() {
    //permet d'effacer les valeurs du form et recommencer à neuf
    var myElem = document.getElementById('liste_utilisateurs_actifs');
    if (myElem === null){
    afficher_liste_utilisateurs(true);
    afficher_liste_utilisateurs(false);
    }
    $.blockUI({
        message: $('.div_utilisateurs_form'),
        css: { top:'20%'}
    });
  }); // $(document).on("click", "#gerer_utilisateurs", function()

}); //$(document).ready(function
/****************FIN PARTIE UTILISATEURS *****************/
