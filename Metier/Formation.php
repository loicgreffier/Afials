<?php

class Formation{

	private $idFormation;
	private $nomFormation;
	private $descriptif;
	private $nomTypeFormation;
	
	public function setIdFormation($id){
		$this->idFormation = $id;
	}
	
	public function getIdFormation(){
		return $this->idFormation;
	}
	
	public function setNomFormation($nom){
		$this->nomFormation = $nom;
	}
	
	public function getNomFormation(){
		return $this->nomFormation;
	}
	
	public function getDescriptif(){
		return $this->descriptif;
	}
	
	public function setDescriptif($descriptif){
		$this->descriptif = $descriptif;
	}
	
	public function setNomTypeFormation($type){
		$this->nomTypeFormation = $type;
	}
	
	public function getNomTypeFormation(){
		return $this->nomTypeFormation;
	}
				
	public function __construct($idFormation,$nomFormation,$descriptif,$nomTypeFormation){
		$this->setIdFormation($idFormation);
		$this->setNomFormation($nomFormation);
		$this->setNomTypeFormation($nomTypeFormation);
		$this->setDescriptif($descriptif);
	}
}
?>