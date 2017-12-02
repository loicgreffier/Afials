<?php

class Avis{

	private $personne;
	private $formation;
	private $note;
	private $commentaire;
	
	public function setPersonne($personne){
		$this->personne = $personne;
	}
	
	public function getPersonne(){
		return $this->personne;
	}
	
	public function setFormation($formation){
		$this->formation = $formation;
	}
	
	public function getFormation(){
		return $this->formation;
	}
	
	public function getNote(){
		return $this->note;
	}
	
	public function setNote($note){
		$this->note = $note;
	}
	
	public function getCommentaire(){
		return $this->commentaire;
	}
	
	public function setCommentaire($commentaire){
		$this->commentaire = $commentaire;
	}
	
	public function __construct($personne, $formation, $note, $commentaire){
		$this->setPersonne($personne);
		$this->setFormation($formation);
		$this->setNote($note);
		$this->setCommentaire($commentaire);
	}
}