<?php

class Forum{

	private $idForum;
	private $intitule;
	
	public function getIdForum(){
		return $this->idForum;
	}
	
	public function setIdForum($id){
		$this->idForum = $id;
	}
	
	public function getIntitule(){
		return $this->intitule;
	}
	
	public function setIntitule($intitule){
		$this->intitule = $intitule;
	}
	
	public function __construct($id, $intitule){
		$this->setidForum($id);
		$this->setIntitule($intitule);
	}
}
?>