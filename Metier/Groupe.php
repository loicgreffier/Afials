<?php

class Groupe{

	private $idGroupe;
	private $nomGroupe;
	private $anneeEtude;
	private $anneeEntree;
	private $anneeSortie;
	private $idCentre;
	
	public function getIdGroupe(){
		return $this->idGroupe;
	}
	
	public function setIdGroupe($idGroupe){
		$this->idGroupe = $idGroupe;
	}
	
	public function getNomGroupe(){
		return $this->nomGroupe;
	}
	
	public function setNomGroupe($nomGroupe){
		$this->nomGroupe = $nomGroupe;
	}
	
	public function getAnneeEtude(){
		return $this->anneeEtude;
	}
	
	public function setAnneeEtude($annee){
		$this->anneeEtude = $annee;
	}
	
	public function getAnneeEntree(){
		return $this->anneeEntree;
	}
	
	public function setAnneeEntree($annee){
		$this->anneeEntree = $annee;
	}
	public function getAnneeSortie(){
		return $this->anneeSortie;
	}
	
	public function setAnneeSortie($annee){
		$this->anneeSortie = $annee;
	}
	
	public function getIdCentre(){
		return $this->idCentre;
	}
	
	public function setIdCentre($id){
		$this->idCentre = $id;
	}
	
	public function __construct($idGroupe, $nomGroupe, $anneeEtude, $anneeEntree, $anneeSortie, $idCentre){
		$this->setIdGroupe($idGroupe);
		$this->setNomGroupe($nomGroupe);
		$this->setAnneeEtude($anneeEtude);
		$this->setAnneeEntree($anneeEntree);
		$this->setAnneeSortie($anneeSortie);
		$this->setIdCentre($idCentre);
	}
}
?>