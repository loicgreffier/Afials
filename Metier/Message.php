<?php

class Message{

	private $idReponse;
	private $corpsReponse;
	private $dateM;
	private $nbAvisFav;
	private $idSujet;
	private $loginPersonne;
	
	
	public function getIdMessage(){
		return $this->idReponse;
	}
	
	public function setIdMessage($id){
		$this->idReponse = $id;
	}
	
	public function getMessage(){
		return $this->corpsReponse;
	}
	
	public function setMessage($corps){
		$this->corpsReponse = $corps;
	}
	
	public function getDate(){
		return $this->dateM;
	}
	
	public function setDate($date){
		$this->dateM = $date;
	}
	
	public function getNbAvisFavorable(){
		return $this->nbAvisFav;
	}
	
	public function setNbAvisFavorable($nb){
		$this->nbAvisFav = $nb;
	}
	
	public function getIdSujet(){
		return $this->idSujet;
	}
	
	public function setIdSujet($id){
		$this->idSujet = $id;
	}
	
	public function getLoginPersonne(){
		return $this->loginPersonne;
	}
	
	public function setLoginPersonne($login){
		$this->loginPersonne = $login;
	}
	
	public function __construct($idr, $corps, $date, $nb, $ids, $login){
		$this->setIdMessage($idr);
		$this->setMessage($corps);
		$this->setDate($date);
		$this->setNbAvisFavorable($nb);
		$this->setIdSujet($ids);
		$this->setLoginPersonne($login);
	}
}
?>