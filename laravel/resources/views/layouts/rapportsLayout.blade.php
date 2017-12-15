<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <header>
         <meta charset="utf-8">
        <meta http-equiv="X-UA-compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>Projet Rapide</title>



        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide_sidebar.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('toastr/build/toastr.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>



        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>

        <script src="{{ asset('toastr/toastr.js') }}"></script>
        <script src="{{ asset('toastr/build/toastr.min.js') }}"></script>

  
    
        <script>

            <?php ini_set('display_errors', 'On'); ?>
            $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
             });

        </script>

        <script type="text/javascript">


          $(document).ready(function() {




          }); //$(document).ready(function()





        </script>
    </header>
    <body>
       
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div id="brand" class="navbar-header">
              <button type="button" id="btn_dropdown" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/home">Projet Rapide</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="top-right links" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="caret"></span></a>
                  <ul id="creer_item" class="dropdown-menu">

                  
                    <li><a id="rapport_projet" href="/rapports/projets">Rapport Projets</a></li>
                    <li><a id="rapport_projet_info" href="/rapports/projetinfo">Projets Info</a></li>
                    <li><a id="rapport_utilisateurs" href="/rapports/utilisateurs">Utilisateurs</a></li>


                  </ul>
                </li>
              </ul>

            </div><!-- /.navbar-collapse -->


             <a id="logout" href="{{ route('logout') }}" rel="tooltip" title="Logout" class="navbar-brand logout pull right"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  <span class="glyphicon glyphicon-log-out"></span>
              </a>



               <div id="div_menu_commentaire_projet" class="navbar-brand  pull right" style="display:none;" >
                <a href="#" id="btn_menu_commentaire_projet" data-toggle="modal" data-target="#projet_commentaire" rel="tooltip" title="Commentaires"  style="color:white;"><span class="glyphicon glyphicon-comment"></span>
                </a>
            </div>

            </div><!-- /.container-fluid -->
        </nav>

<hr />

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>



      @yield('content')
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    </body>
</html>
