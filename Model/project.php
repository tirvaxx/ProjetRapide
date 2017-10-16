<?php

class Project {
	private $nom;
	private $sprint;

	public function __construct($nom, $sprint) {
		$this->nom = $nom;
		$this->sprint = $sprint;
	}

	public function getNom($nom) {
		return $this->nom;
	}
	public function getSprint($sprint) {
		return $this->sprint;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function setSprint($sprint) {
		$this->sprint = $sprint;
	}
	
?>