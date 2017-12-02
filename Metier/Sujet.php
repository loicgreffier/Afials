<?php
	
class Sujet{
	
	private $idSujet;
	private $titreSujet;
	private $nbReponses;
	private $dateDernierMessage;
	private $auteurSujet;
	private $idForum;
	
	/* idSujet */
	public function getIdSujet(){
		return $this->idSujet;
	}

	public function setIdSujet($idSujet){
		$this->idSujet = $idSujet;
	}
	
	/* titreSujet */
	public function getTitreSujet(){
		return $this->titreSujet;
	}

	public function setTitreSujet($sujet){
		$this->titreSujet = $sujet;
	}
	
	/*nbReponses*/
	public function getNbReponses(){
		return $this->nbReponses;
	}
	
	public function setNbReponses($nb){
		$this->nbReponses = $nb;
	}
	
	public function getDateDernierMessage(){
		return $this->dateDernierMessage;
	}
	
	public function setDateDernierMessage($date){
		$this->dateDernierMessage = $date;
	}
	
	/*auteurSujet*/
	public function getAuteurSujet(){
		return $this->auteurSujet;
	}
	
	public function setAuteurSujet($auteur){
		$this->auteurSujet = $auteur;
	}
	
	/*categorie*/
	public function getIdForum(){
		return $this->idForum;
	}
	
	public function setIdForum($cat){
		$this->idForum = $cat;
	}
	
	public function __construct($id, $titre, $nb, $dateDernierMessage, $auteur, $cat){
		$this->setIdSujet($id);
		$this->setTitreSujet($titre);
		$this->setNbReponses($nb);
		$this->setDateDernierMessage($dateDernierMessage);
		$this->setAuteurSujet($auteur);
		$this->setIdForum($cat);
	}
}
?>