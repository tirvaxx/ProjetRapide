
 @extends('layouts.app')
        
@section('content')




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
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="caret"></span></a>
                  <ul id="creer_item" class="dropdown-menu">
                    <li><a id="creer_item_projet" href="#">Projet</a></li>
                    <li><a id="creer_item_sprint" href="#">Sprint</a></li>
                    <li><a id="creer_item_liste" href="#">Liste</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-right">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Rechercher">
                </div>
                <button type="submit" class="btn btn-default">Rechercher</button>
              </form>
            </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
     
<hr />






<p id="message"></p>
   <div id="center-wrapper">  
    <h2 id="sprint_no">Sprint 1</h2>
        <div class="row">
            <h2>GET</h2>
            <button id="getTaches" type="button" class="btn btn-primary">GET</button>
        </div>
        <div id="getTachesData">
            
        </div>
        

        <script type="text/javascript">
            function afficherTache(data) {
                
                var tache = JSON.stringify(data);
                var tachef = JSON.parse(tache);
                
                $.each( JSON.parse(tachef), function( nom, value ) {
                    var nomTache = value.nom;
                    var idTache = value.id;
                    $("#ul_liste_" + 1).append( '<li class="sortable-item"><a id="' + idTache + '" href="#" class="x-remove"><span class="glyphicon glyphicon-remove pull-right"></span></a><span>' + nomTache + '</span></li>');
                    $("#" + idTache).on('click', function(){
                        //  $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //             }
                        // });
                        // var nom = $("#nom_tache").val();
                        // console.log(nom);
                        // var description = $("#description_tache").val();
                        // console.log(value);
                        // $.ajax({
                        //     /* the route pointing to the post function */
                        //     url: "{{ URL::to('deleteTaches') }}",
                        //     type: 'POST',
                        //     /* send the csrf-token and the input to the controller */
                        //     data: value,
                        //     dataType: 'JSON',
                        //     /* remind that 'data' is the response of the AjaxController */
                        //     success: function () { 
                        //         alert('successbis');
                        //     }
                        // });
                        deleteTache(value);
                    });
                });
            }
            function deleteTache(value){
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                        });
                        var nom = $("#nom_tache").val();
                        console.log(nom);
                        var description = $("#description_tache").val();
                        console.log(value);
                        $.ajax({
                            /* the route pointing to the post function */
                            url: "{{ URL::to('deleteTaches') }}",
                            type: 'POST',
                            /* send the csrf-token and the input to the controller */
                            data: value,
                            dataType: 'JSON',
                            /* remind that 'data' is the response of the AjaxController */
                            success: function () { 
                                alert('successbis');
                            }
                        });
            }

            $(document).ready(function() {
                
                //$('#getTaches').on('click',function(){
                    $.get("{{URL::to('/getTaches')}}", function(data){
                        $('#getTachesData').append(data);
                        afficherTache(data);
                    })    
               // })
                

                $('#form_tache').on( 'submit', function(event){
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                    var nom = $("#nom_tache").val();
                    console.log(nom);
                    var description = $("#description_tache").val();
                    console.log(this);
                    $.ajax({
                        /* the route pointing to the post function */
                        url: "{{ URL::to('pushTaches') }}",
                        type: 'POST',
                        /* send the csrf-token and the input to the controller */
                        data: $(this).serialize(),
                        dataType: 'JSON',
                        /* remind that 'data' is the response of the AjaxController */
                        success: function () { 
                            alert('successbis');
                        }
                    });
                }); 

            });
        </script>

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
    <form id="form_tache" action="#" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- securite contre les failles sur les requests -->
       
        <fieldset>
            <legend>Ajouter une tache</legend>
                <div class="form-group">
                        <label for="nom_tache">Nom de la tache</label>
                        <input type="text" class="form-control" id="nom_tache" name="nom_tache" placeholder="Nom" />                            
                </div>
                <div class="form-group">
                         <label for="description_tache">Description de la tache</label>
                        <textarea class="form-control" id="description_tache" name="description_tache" placeholder="Description"></textarea>               
                </div>
                <div class="form-group">
                    <button type="submit" id="btn_tache_ajouter" class="btn btn-primary" >Ajouter</button>
                    <button type="button" id="btn_tache_fermer" class="btn btn-primary" >Fermer</button>
                </div>
        </fieldset>
      
    </form>

</div>
<script type="text/javascript">

     

    //     e.preventDefault(); 

    //     var formData = {
    //         task: $('#nom_tache').val(),
    //         description: $('#description_tache').val(),
    //     }

    //     //used to determine the http verb to use [add=POST], [update=PUT]
    //     var state = $('#btn_tache_ajouter').val();

    //     var type = "POST"; //for creating new resource
    //     var task_id = $('#nom_tache').val();
    //     var my_url = "http://localhost:8080/projetRapide/laravel/public/taches";

        

    //     console.log(formData);

    //     $.ajax({

    //         type: type,
    //         url: my_url,
    //         data: formData,
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data);

                
    //         },
    //         error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });
    // });
     // $(document).ready(function() {
                
     //            $('#getTaches').on('click',function(){
     //                $.post("{{URL::to('taches')}}", function(data){
     //                    console.log(data); 
     //                })
                    
     //            })

     //        });
</script>





        
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

@endsection