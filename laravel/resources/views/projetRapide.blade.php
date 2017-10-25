<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projet Rapide</title>
      




        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">






         <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      
          <style>
            #draggable { width: 150px; height: 150px; padding: 0.5em; border:thin solid red; }
          </style>
          <!-- Pour les choses qui se drag and drop-->
          <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
          <link rel="stylesheet" href="<?php echo asset('css/devheart-examples.css')?>" type="text/css"> 
          <!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" /> -->
          <!-- <link rel="stylesheet" type="text/css" href="./View/devheart-examples.css" media="screen" /> -->
       <!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->

        <script src="{{ asset('js/jquery.min.js') }}"></script>
          <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        
          <script>
          $( function() {
                $( "#draggable" ).draggable();
          } );
          //https://devheart.org/articles/jquery-customizable-layout-using-drag-and-drop/
          </script>

        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}> 






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
     
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <span>a</span>
                </div>
                <div class="col-md-2">
                    <span>b</span>
                </div>
                <div class="col-md-2">
                    <span>c</span>
                </div>
            </div>

        </div>



<hr />


      <h1>1) Page avec bouton créer</h1>
        <input type="button" value="Créer projet" onClick="creerProjet();"></input>
        <input type="button" value="Créer liste" onClick="creerListe();"/>
        <input type="button" value="AfficherCacherListe" onClick="showHideListe();"/>

        <div id="center-wrapper">

            <div class="dhe-example-section1" id="ex-1-1" >
                <div class="dhe-example-section-header">
                    <h3 class="dhe-h3 dhe-example-title">Example 1.1: A single sortable list</h3>
                    <div class="dhe-example-description">Drag and drop items within a list.</div>
                </div>
                <div class="dhe-example-section-content1" id="fixedtop1">
                    <!-- BEGIN: XHTML for example 1.1 -->
                    <div id="example-1-1">

                        <ul class="sortable-list">
                            <li class="sortable-item">Sortable item A</li>
                            <li class="sortable-item">Sortable item B</li>
                            <li class="sortable-item">Sortable item C</li>
                        </ul>

                    </div>
                    <!-- END: XHTML for example 1.1 -->

                </div>
            </div>

            <div class="dhe-example-section2" id="ex-1-3">
                <div class="dhe-example-section-header">
                    <h3 class="dhe-h3 dhe-example-title">Example 1.3: Sortable and connectable lists with visual helper</h3>
                    <div class="dhe-example-description">Drag and drop items within and between lists. A visual helper is displayed indicating where the item will be positioned if dropped.</div>
                </div>
                <div class="dhe-example-section-content2">

                    <!-- BEGIN: XHTML for example 1.3 -->

                    <div id="example-1-3">

                        <div class="column left first">

                            <ul class="sortable-list">
                                <li class="sortable-item">Sortable item A</li>
                                <li class="sortable-item">Sortable item B</li>
                            </ul>

                        </div>

                        <div class="column left">

                            <ul class="sortable-list">
                                <li class="sortable-item">Sortable item C</li>
                                <li class="sortable-item">Sortable item D</li>
                            </ul>

                        </div>

                        <div class="column left">

                            <ul class="sortable-list">
                                <li class="sortable-item">Sortable item E</li>
                            </ul>

                        </div>

                        <div class="clearer">&nbsp;</div>

                    </div>

                    <!-- END: XHTML for example 1.3 -->

                </div>
            </div>


        </div>
  
<!-- Example JavaScript files -->
 

<!-- Example jQuery code (JavaScript)  -->
        <script type="text/javascript">

        $(document).ready(function(){

            // Example 1.1: A single sortable list
            $('#example-1-1 .sortable-list').sortable();

            // Example 1.3: Sortable and connectable lists with visual helper
            $('#example-1-3 .sortable-list').sortable({
                connectWith: '#example-1-3 .sortable-list',
                placeholder: 'placeholder',
            });

        });


        </script>


    
     
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

     </body>    
</html>