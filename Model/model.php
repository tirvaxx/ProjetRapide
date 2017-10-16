<?php
  function getTask($idTask) {
  $bdd = getBdd();
  $task = $bdd->prepare('**REQUETE SQL**');
  $task->execute(array($idBillet));
  if ($task->rowCount() == 1)
    return $task->fetch();  // Accès à la première ligne de résultat
  else
   throw new Exception("Aucun billet ne correspond à l'identifiant '$idTask'");
}

function getProject($idProjet) {
  $bdd = getBdd();
  $projet = $bdd->prepare('**REQUETE SQL**');
  $projet->execute(array($idProjet));
  return $projet;
}

function getSprint($idSprint) {
  $bdd = getBdd();
  $sprint = $bdd->prepare('**REQUETE SQL**');
  $sprint->execute(array($idSprint));
  return $sprint;
}

function getList($idList) {
  $bdd = getBdd();
  $list = $bdd->prepare('**REQUETE SQL**');
  $list->execute(array($idList));
  return $list;
}

?>

