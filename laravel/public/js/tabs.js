 // Actual addTab function: adds new tab using the input from the form above
function sprint_add_tab(id, numero, sprint_retard) {
	//var label = noSprint.val() || "Sprint " + tabCounter,

	var label = "Sprint " + numero;
	//   id = "tabs-" + tabCounter,
	//  id = "tabs-" + id,

	tabTemplate = '<li><a href="#{href}" sprint_unique_name_id="sprint_'+id+'" >#{label}</a><span class="glyphicon glyphicon-flag" rel="tooltip" title="Sprint est en retard." style="color:red;' + ( sprint_retard == true || sprint_retard == "true" ?  "display:inline; " : "display:none; " ) + '"></span>   </li>';

	li = $( tabTemplate.replace( /#\{href\}/g, "#sprint_" + id ).replace( /#\{label\}/g, label ) );
	//  tabContentHtml = tabContent.val();

	$("#tabs > ul").append( li );
	//tabs.append( "<div id='" + id + "'><p></p></div>" );
	$("#tabs").append( "<div id='sprint_" + id + "'><p id=\"sprint_message\"></p><p></p></div>" );
	$("#tabs").tabs( "refresh" );
	$("#tabs").tabs({ active: 0 });
	// tabCounter++;
}

function sprint_modifier_tab(id, numero) {

	var label = "Sprint " + numero;
	$("[sprint_unique_name_id=sprint_"+id+"]").text(label);

}

// TODO : à faire et vérifier qu'il n'y a pas de tâches et de listes à l'intérieur
function sprint_delete_tab(id, numero) {
	//var label = noSprint.val() || "Sprint " + tabCounter,

	var label = "Sprint " + numero;
	//   id = "tabs-" + tabCounter,
	//  id = "tabs-" + id,
	tabTemplate = "<a href='#{href}'>#{label}</a>";
	li = $( tabTemplate.replace( /#\{href\}/g, "#sprint_" + id ).replace( /#\{label\}/g, label ) );
	//  tabContentHtml = tabContent.val();

	$("#li").filter(":contains("+li+")").remove().
	//$("#tabs > ul").$( li ).remove();
	//tabs.append( "<div id='" + id + "'><p></p></div>" );
	//$("#tabs").append( "<div id='sprint_" + id + "'><p id=\"sprint_message\"></p><p></p></div>" );
	$("#tabs").tabs( "refresh" );
	$("#tabs").tabs({ active: 0 });
	// tabCounter++;
}

$(document).ready(function(){




  // Close icon: removing the tab on click
     $("#tabs").on( "click", "span.ui-icon-close", function() {
      var tabs = $( "#tabs" ).tabs();
      var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      $( "#" + panelId ).remove();
      tabs.tabs( "refresh" );
    });

    $("#tabs").on( "keyup", function( event ) {

      if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
        var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
        $( "#" + panelId ).remove();
         $("#tabs").tabs( "refresh" );
      }
    });



}); //$(document).ready(function
