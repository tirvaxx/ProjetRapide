
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <header>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>jQuery UI Draggable - Default functionality</title>
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      
      <style>
        #draggable { width: 150px; height: 150px; padding: 0.5em; border:thin solid red; }
      </style>
      <!-- Pour les choses qui se drag and drop-->
      <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
       <link rel="stylesheet" href="<?php echo asset('css/drag_and_drop.css')?>" type="text/css"> 
      <!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" /> -->
      <!-- <link rel="stylesheet" type="text/css" href="./View/devheart-examples.css" media="screen" /> -->
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="javascript/fonctions.js"></script>
      <script>
      $( function() {
            $( "#draggable" ).draggable();
      } );
      //https://devheart.org/articles/jquery-customizable-layout-using-drag-and-drop/
      </script>
      
    </header>
    <body>
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
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1>
        <h1>1) On met des lignes pour remplir</h1><h1>1) On met des lignes pour remplir</h1>

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
     </body>    
</html>