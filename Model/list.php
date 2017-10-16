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
	public function getlistOfTask($listOfTask) {
		return $this->listOfTask;
	}
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function setlistOfTask($listOfTask) {
		$this->listOfTask = $listOfTask;
	}
?>