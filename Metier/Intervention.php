<?php

class Intervention{

	private $idIntervention;
	private $dateDebut;
	private $dateFin;
	private $salle;
	private $idFormation;
	private $nomFormation;
	private $idCentre;
	private $nomCentre;
	private $villeCentre;
	private $loginPersonne;
	
	/* idIntervention */
	public function setIdIntervention($id){
		$this->idIntervention = $id;
	}
	
	public function getIdIntervention(){
		return $this->idIntervention;
	}
	
	/* idFormation*/
	public function setIdFormation($id){
		$this->idFormation = $id;
	}
	
	public function getIdFormation(){
		return $this->idFormation;
	}
	
	/* nomFormation*/
	public function setNomFormation($nom){
		$this->nomFormation = $nom;
	}
	
	public function getNomFormation(){
		return $this->nomFormation;
	}
	
	/* idCentre */
	public function getIdCentre(){
		return $this->id;
	}

	public function setIdCentre($id){
		$this->id = $id;
	}
		
	/* nomCentre */
	public function getNomCentre(){
		return $this->nomCentre;
	}

	public function setNomCentre($nomCentre){
		$this->nomCentre = $nomCentre;
	}
	
	/* nom Ville */
	public function getVilleCentre(){
		return $this->villeCentre;
	}
	
	public function setVilleCentre($nomVille){
		$this->villeCentre = $nomVille;
	}
	
	/* horaire */
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function setDateDebut($date){
		$this->dateDebut = $date;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	public function setDateFin($date){
		$this->dateFin = $date;
	}
	
	/* salle */
	public function getSalle(){
		return $this->salle;
	}
	
	public function setSalle($salle){
		$this->salle = $salle;
	}
	
	/* loginPersonne */
	public function getLoginPersonne(){
		return $this->loginPersonne;
	}
	
	public function setLoginPersonne($login){
		$this->loginPersonne = $login;
	}
	
	public function __construct($idIntervention, $dateDebut, $dateFin, $salle, $idFormation, $nomFormation, $idCentre, $nomCentre, $villeCentre, $login){
		$this->setIdIntervention($idIntervention);
		$this->setIdFormation($idFormation);
		$this->setNomFormation($nomFormation);
		$this->setIdCentre($idCentre);
		$this->setNomCentre($nomCentre);
		$this->setVilleCentre($villeCentre);
		$this->setDateDebut($dateDebut);
		$this->setDateFin($dateFin);
		$this->setSalle($salle);
		$this->setLoginPersonne($login);
	}
}
?>