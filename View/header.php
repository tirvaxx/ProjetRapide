<!doctype html>
<html>
<header>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>jQuery UI Draggable - Default functionality</title>
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      
      <style>
        #draggable { width: 150px; height: 150px; padding: 0.5em; border:thin solid red; }
      </style>
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
