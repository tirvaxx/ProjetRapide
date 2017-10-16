<?php

require 'Modele.php';

// Affiche la liste de tous les billets du blog
function accueil() {
  $billets = getBillets();
  require 'vueAccueil.php';
}


?>