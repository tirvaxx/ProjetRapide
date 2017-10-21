
function creerProjet()
{
 alert("allo");
}
function creerListe() {
	
    alert("cr\351ation liste12");
}

var estvisible = true;	

function showHideListe() {

	var obj = document.getElementById("fixedtop1");
	if(estvisible == true){			
		$('.dhe-example-section-content1').hide("slide", { direction: "right" }, 1000);
		estvisible=false;
	}
	else
	{
		
		$('.dhe-example-section-content1').show("slide");
		estvisible=true;
	}
//	$('.dhe-example-section-content1').toggle();
}