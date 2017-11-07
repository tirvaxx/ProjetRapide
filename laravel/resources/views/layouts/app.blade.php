<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>Projet Rapide</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>


  <script>

    <?php ini_set('display_errors', 'On'); ?>


    $(document).ready(function() {

        $('a.btn').click(function() {

            var list_id_from_a =  $(this).attr('id');
            //on s'assure que le <a> cliquer est un bouton pour ajouter une tache sinon exit
            //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd
            if(!(typeof list_id_from_a != 'undefined' && list_id_from_a.indexOf("btn_ajouter_tache_Liste") >= 0)){

                return;
            }

            var liste_no = list_id_from_a.replace("btn_ajouter_tache_Liste_", "");
            $("body").data("ajout_liste_no", liste_no);


            $.blockUI({
                 message: $('#tache_form')
            });
        });
        $('#btn_tache_fermer').click(function() {
            $("body").removeData("ajout_liste_no");
            $('#form_tache')[0].reset();
            $.unblockUI();
            return false;
        });
        $('#btn_tache_ajouter').click(function() {

            var liste_no = $("body").data("ajout_liste_no");
            var nom_tache = $("#nom_tache").val();
            if(nom_tache == ""){
                nom_tache = "Non Défini";
            }

            $("#ul_liste_" + liste_no).append( '<li id="li_da" class="sortable-item ui-sortable-handle"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span>' + nom_tache + '</span></li>'


        )});

            //utilisation de delegate au lieu de juste click car la fonctionalité est
            //ajouté dynamiquement... sinon, ca ne marche pas
            $("body").delegate('a.x-remove','click',function() {

                        //alert($(this).parent().attr('id'));
                        $(this).parent().remove();
                    })


                });


     $(document).on("click", "#creer_item_liste", function() {


        $("#container-list-lvl2").append(

            '<div class="container-list">                                                                           \
                <div class="panel panel-default column left"  id="liste_1">                                         \
                        <div class="panel-heading">                                                                 \
                            <span>liste 3</span>                                                                    \
                        </div>  <!-- panel-title -->                                                                \
                                                                                                                    \
                        <div class="panel-body">                                                                    \
                             <ul class="sortable-list" id="ul_liste_1">                                             \
                                                                                                                    \
                            </ul>                                                                                   \
                                                                                                                    \
                        </div> <!-- panel-body -->                                                                  \
                        <div class="panel-footer">                                                                  \
                           <a href="#" id="btn_ajouter_tache_Liste_1" class="btn btn-link right">ajouter une tache</a> \
                        </div> <!-- panel-footer -->                                                                \
                                                                                                                    \
                </div>  <!-- panel-default -->                                                                      \
            </div>  <!-- #container-liste -->'

        );


    });





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
</header>
     <body>
         @yield('content')
     </body>
</html>
