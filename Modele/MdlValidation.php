<?php 
Autoloader::getInstance()->autoload(array('DALValidation'));

class ModeleValidation{

	public function __construct(){}
		
	public function ValiderIdForum($idForum){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdForum($idForum);
	}
	
	public function ValiderNomForum($nomForum){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomForum($nomForum);
	}
	
	public function ValiderIdSujet($idSujet){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdSujet($idSujet);
	}
	
	public function ValiderNomSujet($nomSujet){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomSujet($nomSujet);
	}
	
	public function ValiderIdMessage($idMessage){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdMessage($idMessage);
	}
	
	public function ValiderIdCentre($idCentre){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdCentre($idCentre);
	}
	
	public function ValiderNomCentre($nomCentre){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomCentre($nomCentre);
	}
	
	public function ValiderLoginPersonne($login){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderLoginPersonne($login);
	}
	
	public function ValiderLoginEnseignant($login){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderLoginEnseignant($login);
	}
	
	public function ValiderLoginEtudiant($login){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderLoginEtudiant($login);
	}
	
	public function ValiderIdFormation($idFormation){
		
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdFormation($idFormation);
	}
	
	public function ValiderNomFormation($nomFormation){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomFormation($nomFormation);
	}
	
	public function ValiderDisponibiliteHoraire($dateDebut,$dateFin){
		
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderDisponibiliteHoraire($dateDebut, $dateFin);
	}
	
	public function ValiderIdIntervention($idIntervention){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdIntervention($idIntervention);
	}
	
	public function ValiderNomTypeFormation($nom){
		
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomTypeFormation($nom);
	}
	
	public function ValiderIdGroupe($idGroupe){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdGroupe($idGroupe);
	}
	
	public function ValiderIdDevoir($idDevoir){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderIdDevoir($idDevoir);
	}

	public function ValiderNoteMaxExistante($noteMax, $idDevoir){
		
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNoteMaxExistante($noteMax, $idDevoir);
	}
	
	public function ValiderNomDevoirExistant($nomDevoir, $idDevoir){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomDevoirExistant($nomDevoir, $idDevoir);
	}
		
	public function ValiderCoefficientDevoirExistant($coefficient, $idDevoir){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderCoefficientDevoirExistant($coefficient, $idDevoir);
	}
	
	public function ValiderNomPrenomEnseignant($nom, $prenom){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderNomPrenomEnseignant($nom, $prenom);
	}
	
	public function ValiderCommentaireDispo($login, $idFormation){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderCommentaireDispo($login, $idFormation);
	}
	
	public function ValiderMdpPersonne($mdp, $login){
	
		$DALValidation = new DALValidation();
		return $DALValidation->ValiderMdpPersonne($mdp, $login);
	}
}
?>