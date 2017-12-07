 // Actual addTab function: adds new tab using the input from the form above
function sprint_add_tab(id, numero) {
	//var label = noSprint.val() || "Sprint " + tabCounter,

	var label = "Sprint " + numero;
	//   id = "tabs-" + tabCounter,
	//  id = "tabs-" + id,
	tabTemplate = "<li><a href='#{href}'>#{label}</a></li>";
	li = $( tabTemplate.replace( /#\{href\}/g, "#sprint_" + id ).replace( /#\{label\}/g, label ) );
	//  tabContentHtml = tabContent.val();

	$("#tabs > ul").append( li );
	//tabs.append( "<div id='" + id + "'><p></p></div>" );
	$("#tabs").append( "<div id='sprint_" + id + "'><p id=\"sprint_message\"></p><p></p></div>" );
	$("#tabs").tabs( "refresh" );
	$("#tabs").tabs({ active: 0 });
	// tabCounter++;
}

$(document).ready(function(){




                               
           //     $( function() {
            //    var noSprint = $( "#no_sprint" );
            //    var  tabContent = $( "#tab_content" );
                  //tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
                  //tabTemplate = "<li><a href='#{href}'>#{label}</a></li>",
              

                //var tabs = $( "#tabs" ).tabs();

                  // $( "#creer_item_sprint" ).button().on( "click", function() {
                //     dialog.dialog( "open" );
                //   });

              
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