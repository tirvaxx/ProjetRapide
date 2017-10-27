<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projet Rapide</title>
      
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <!--     <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  -->
        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>          
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
     /*     $( function() {
                $( "#draggable" ).draggable();
          } );
    */
            //https://devheart.org/articles/jquery-customizable-layout-using-drag-and-drop/
        </script>
    <!--    
        <style>
            #draggable { width: 150px; height: 150px; padding: 0.5em; border:thin solid red; }
        </style>
    -->

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


<h1>Sprint 1</h1>
   <div id="center-wrapper">  
        <div class="container-list-lvl2" id="container-list-lvl2">

            
            <div class="container-list"> 
                <div class="panel panel-default column left">
                        <div class="panel-heading">
                            <span>liste 1</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list">
                                            <li class="sortable-item">Sortable item A</li>
                                            <li class="sortable-item">Sortable item B</li>
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->
            
            <div class="container-list"> 
                <div class="panel panel-default column left">
                        <div class="panel-heading">
                            <span>liste 1</span>
                        </div>  <!-- panel-title -->

                        <div class="panel-body">
                             <ul class="sortable-list">
                                            <li class="sortable-item">Sortable item A</li>
                                            <li class="sortable-item">Sortable item B</li>
                            </ul>

                        </div> <!-- panel-body -->
                        <div class="panel-footer">
                           <a href="#" class="btn btn-link right">ajouter une tache</a>
                        </div> <!-- panel-footer -->

                </div>  <!-- panel-default -->
            </div>  <!-- #container-liste -->

        </div> <!-- #container-list-lvl2 -->
    </div>  <!-- #center-wrapper -->


























        <script type="text/javascript">

        $(document).ready(function(){


            // Example 1.3: Sortable and connectable lists with visual helper
            $('.container-list .sortable-list').sortable({
                connectWith: '.container-list .sortable-list',
                placeholder: 'placeholder',
            });

        });


        </script>


    
     
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

     </body>    
</html>