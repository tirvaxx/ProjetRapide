<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projet Rapide</title>
      
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   
        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>          
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
      
    
  <script>
  
    
      

    $(document).ready(function() { 
        $('a.btn').click(function() { 
            
            var list_id_from_a =  $(this).attr('id');
            //on s'assure que le <a> cliquer est un bouton pour ajouter une tache sinon exit
            //il faut que le id de <a> commence par btn_ajouter_tache_Liste + _ + le id de la liste dans la bd 
            if(!(typeof list_id_from_a != 'undefined' && list_id_from_a.indexOf("btn_ajouter_tache_Liste") >= 0)){
                alert("t");
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
            $("#ul_liste_" + liste_no).append( '<li id="li_da" class="sortable-item"><a href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span>' + nom_tache + '</span></li>' 
            )}); 


$("body").delegate('a.x-remove','click',function() {
       
            alert("remove");
        })

         
    }); 
  
    
  



  </script>
    </header>
    <body>
        

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Projet Rapide</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-right">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Rechercher">
                </div>
                <button type="submit" class="btn btn-default">Rechercher</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
     
<hr />



   <div id="center-wrapper">  
    <h2 id="sprint_no">Sprint 1</h2>
        <div class="container-list-lvl2" id="container-list-lvl2">

            
            <div class="container-list"> 
                <div class="panel panel-default column left"  id="liste_1">
                        <div class="panel-heading">
                            <span>liste 1</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list" id="ul_liste_1">
                                    <li id="li_c" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item C</span>
                                            </li>
                                    <li id="li_da" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item D</span>
                                    </li>
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#" id="btn_ajouter_tache_Liste_1" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->
            
            <div class="container-list"> 
                <div class="panel panel-default column left">
                        <div class="panel-heading">
                            <span>liste 2</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list" id="ul_liste_2" >
                                            <li id="li_a" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item A</span>
                                            </li>
                                            <li id="li_b" class="sortable-item">
                                                <a href="#" class="x-remove">
                                                    <span class="glyphicon glyphicon-remove pull-right"></span>
                                                </a>
                                                <span>Sortable item B</span>
                                            </li>
                                          
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#"  id="btn_ajouter_tache_Liste_2" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->

        </div> <!-- #container-list-lvl2 -->
    </div>  <!-- #center-wrapper -->




<div id="tache_form" style="display:none">
    <form id="form_tache">
        <fieldset>
            <legend>Ajouter une tache</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tache</label>
                        <input type="text" class="form-control" id="nom_tache" placeholder="Nom" />                            
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tache</label>
                        <textarea class="form-control" id="description_tache" placeholder="Description"></textarea>               
                </div>
                <div class="form-group">
                    <input type="button" id="btn_tache_ajouter" class="btn btn-default pull-right" value="Ajouter">
                    <input type="button" id="btn_tache_fermer" class="btn btn-default pull-right" value="Fermer">
                </div>
        </fieldset>
      
    </form>

</div>




















        <script type="text/javascript">

        $(document).ready(function(){


            // Example 1.3: Sortable and connectable lists with visual helper
            $('.container-list .sortable-list').sortable({
                connectWith: '.container-list .sortable-list',
                placeholder: 'placeholder',
            });

            $('#form_tache')[0].reset();

        });


        </script>


    
     
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

     </body>    
</html>