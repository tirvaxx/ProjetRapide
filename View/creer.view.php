<?php require "header.php" ?>

<h1>1) Page avec bouton créer</h1>
<input type="button" value="Créer projet" onClick="creerProjet();"></input>
<input type="button" value="Créer liste" onClick="creerListe();"/>
<input type="button" value="AfficherCacherListe" onClick="showHideListe();"/>

<div id="center-wrapper">

	<div class="dhe-example-section" id="ex-1-1" >
		<div class="dhe-example-section-header">
			<h3 class="dhe-h3 dhe-example-title">Example 1.1: A single sortable list</h3>
			<div class="dhe-example-description">Drag and drop items within a list.</div>
		</div>
		<div class="dhe-example-section-content1">

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

	<div class="dhe-example-section" id="ex-1-3">
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
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.custom.min.js"></script>

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



<?php require "footer.php" ?>