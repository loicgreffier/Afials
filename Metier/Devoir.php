<?php

class Devoir{

	private $idDevoir;
	private $nomDevoir;
	private $dateDevoir;
	private $noteMax;
	private $coefficient;
	private $idFormation;
	private $loginPersonne;

	public function getIdDevoir(){
		return $this->idDevoir;
	}
	
	public function setIdDevoir($idDevoir){
		$this->idDevoir = $idDevoir;
	}
	
	public function getNomDevoir(){
		return $this->nomDevoir;
	}
	
	public function setNomDevoir($nomDevoir){
		$this->nomDevoir = $nomDevoir;
	}
	
	public function setDate($date){
		$this->dateDevoir = $date;
	}
	
	public function getDate(){
		return $this->dateDevoir;
	}
	
	public function getNoteMax(){
		return $this->noteMax;
	}
	
	public function setNoteMax($notemax){
		$this->noteMax = $notemax;
	}
	
	public function getCoefficient(){
		return $this->coefficient;
	}
	
	public function setCoefficient($coefficient){
		$this->coefficient = $coefficient;
	}
	
	public function getIdFormation(){	
		return $this->idFormation;
	}
	
	public function setIdFormation($idFormation){
		$this->idFormation = $idFormation;
	}
	
	public function getLoginEnseignant(){
		return $this->loginPersonne;
	}
	
	public function setLoginEnseignant($login){
		$this->loginPersonne = $login;
	}
	
	public function __construct($idDevoir, $nom, $date, $notemax, $coeff, $idFormation, $loginEns){
		$this->setIdDevoir($idDevoir);
		$this->setNomDevoir($nom);
		$this->setDate($date);
		$this->setNoteMax($notemax);
		$this->setCoefficient($coeff);
		$this->setIdFormation($idFormation);
		$this->setLoginEnseignant($loginEns);
	}
}
?>