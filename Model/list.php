<?php

class Task {
	private $nom;
	private $listOfTask;

	public function __construct($nom, $listOfTask) {
		$this->nom = $nom;
		$this->listOfTask = $listOfTask;
	}

	public function getNom($nom) {
		return $this->nom;
	}
	public function getDescription($listOfTask) {
		return $this->listOfTask;
	}
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function setDescription($listOfTask) {
		$this->listOfTask = $listOfTask;
	}
?>