<?php

class TypeFormation{

	private $nomTypeFormation;
	
	public function getNomTypeFormation(){
		return $this->nomTypeFormation;
	}
	
	public function setNomTypeFormation($nom){
		$this->nomTypeFormation = $nom;
	}
	
	public function __construct($nom){
		$this->setNomTypeFormation($nom);
	}
}
?>