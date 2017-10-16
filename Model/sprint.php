<?php

class Sprint {
	private $nom;
	private $listOfList;

	public function __construct($nom, $listOfList) {
		$this->nom = $nom;
		$this->listOfList = $listOfList;
	}

	public function getNom($nom) {
		return $this->nom;
	}
	public function getlistOfList($listOfList) {
		return $this->listOfList;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function setlistOfList($listOfList) {
		$this->listOfList = $listOfList;
	}
	
?>