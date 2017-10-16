<?php

class Task {
	private $nom;
	private $description;
	private $dateDue;

	public function __construct($nom, $description, $dateDue) {
		$this->nom = $nom;
		$this->descriptio = $description;
		$this->dateDue = $dateDue;
	}

	public function getNom($nom) {
		return $this->nom;
	}
	public function getDescription($description) {
		return $this->description;
	}
	public function getDateDue($dateDue) {
		return $this->dateDue;
	}
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function setDateDue($dateDue) {
		$this->dateDue = $dateDue;
	}
?>