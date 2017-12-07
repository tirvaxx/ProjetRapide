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

        <link rel="stylesheet" type="text/css" href={{ asset('css/projetrapide.css') }}>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('js/commentaire.js') }}"></script>
        <script src="{{ asset('js/projet.js') }}"></script>
        <script src="{{ asset('js/tabs.js') }}"></script>
        <script src="{{ asset('js/sprint.js') }}"></script>
        <script src="{{ asset('js/liste.js') }}"></script>
        <script src="{{ asset('js/tache.js') }}"></script>
       
 
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

      $( ".date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#tabs" ).tabs();
      //Permet d'afficher des tooltips de types Bootstrap
      $("[rel=tooltip]").tooltip({ placement: 'top'});


      $(".btn_fermer_ui").click(function(){
          $.unblockUI();
      });


    }); //$(document).ready(function()





  </script>
</header>
    <body>
        @yield('content')
    </div>

    <!-- Scripts -->

    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    </body>
</html>
