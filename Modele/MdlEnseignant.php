<?php 
Autoloader::getInstance()->autoload(array('DALEnseignant','Personne','Formation','CentreFormation','Intervention','TypeFormation','Groupe','Devoir','Note'));

class ModeleEnseignant{

	public function __construct(){}
	
	public function isEnseignant(){
		
		if(isset($_SESSION['role']) && $_SESSION['role'] == "enseignant")
			return true;
	}
	
	/*** FORMATION ***/
	public function GetNbEnseignant(){
		
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbEnseignant();
	}
	
	public function ModifierFormation($idFormation, $nomFormation, $description, $nomTypeFormation){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->ModifierFormation($idFormation, $nomFormation, $description, $nomTypeFormation);	
	}
	
	public function GetListeEnseignants($pageCourante){
	
		$DALEnseignant = new DALEnseignant();
		$listeEnseignants = $DALEnseignant->GetListeEnseignants($pageCourante);
		foreach($listeEnseignants as $enseignant)
			$tEnseignants[] = new Personne($enseignant[0],$enseignant[1],$enseignant[2],$enseignant[3],$enseignant[4],$enseignant[5]);
		return $tEnseignants;
	}
	
	public function GetNbFormationEnseignant($loginEnseignant){
		
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbFormationEnseignant($loginEnseignant);
	}
	
	public function GetFormationsEnseignant($login,$pageCouranteFormation){
	
		$DALEnseignant = new DALEnseignant();
		
		if(empty($pageCouranteFormation))
			$formations = $DALEnseignant->GetFormationsEnseignant($login);
		if(!empty($pageCouranteFormation))
			$formations = $DALEnseignant->GetFormationsEnseignantParPage($login,$pageCouranteFormation);
		
		if(!empty($formations)){
			foreach($formations as $formation)
				$tFormations[] = new Formation($formation[0],$formation[1],$formation[2],$formation[3]);
			return $tFormations;
		}
	}
	
	public function GetListeTypesFormation(){
		
		$DALEnseignant = new DALEnseignant();
		$listeTypesFormation = $DALEnseignant->GetListeTypesFormation();
		if(!empty($listeTypesFormation)){
			foreach($listeTypesFormation as $type)
				$tTypes[] = new TypeFormation($type[0]);
			return $tTypes;
		}
	}
	
	public function AjouterFormation($nomFormation,$descriptif,$login,$nomtype){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterFormation($nomFormation,$descriptif,$login,$nomtype);
	}
	
	public function AjouterTypeFormation($nomType){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterTypeFormation($nomType);
	}
	
	/*** FORUM ***/
	public function SupprimerForum($idForum){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerForum($idForum);
	}
	
	public function AjouterForum($titreForum){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterForum($titreForum);
	}
	
	public function SupprimerSujet($idSujet){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerSujet($idSujet);
	}
	
	public function SupprimerMessage($idMessage){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerMessage($idMessage);
	}
					
	public function SupprimerFormation($idFormation,$loginPersonne){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->SupprimerFormation($idFormation,$loginPersonne);
	}
	
	/** AGENDA **/
	public function GetNbInterventionsEnseignant($login){
		
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbInterventionsEnseignant($login);
	}
	
	public function GetInterventionsEnseignant($login,$pageCourante){
		
		$DALEnseignant = new DALEnseignant();
		$interventions = $DALEnseignant->GetInterventionsEnseignant($login,$pageCourante);
		foreach($interventions as $intervention)
			$tInterventions[] = new Intervention($intervention[0],$intervention[1],$intervention[2],$intervention[3],$intervention[4],$intervention[5], $intervention[6],$intervention[7],$intervention[8],$intervention[9]);
		return $tInterventions;
	}
		
	public function AjouterIntervention($dateDebut,$dateFin,$nbRepetitions,$salle,$login,$idCentre,$idFormation){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->AjouterIntervention($dateDebut,$dateFin,$nbRepetitions,$salle,$login,$idCentre,$idFormation);
	}
	
	public function SupprimerIntervention($idIntervention){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->SupprimerIntervention($idIntervention);
	}	
	
	public function ViderAgenda(){
		
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->ViderAgenda();
	}
	
	/* CENTRE FORMATION */
	public function ModifierCentreFormation($idCentre, $nomCentre, $villeCentre, $rueCentre, $cpCentre, $loginChef){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->ModifierCentreFormation($idCentre,$nomCentre, $villeCentre, $rueCentre, $cpCentre, $loginChef);
	}
															
	public function GetNbCentresFormationEnseignant($loginEnseignant){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbCentresFormationEnseignant($loginEnseignant);
	}
	
	public function GetCentresFormationEnseignant($login,$pageCourante){
		
		$DALEnseignant = new DALEnseignant();
		
		if(empty($pageCourante))
			$centresformation = $DALEnseignant->GetCentresFormationEnseignant($login);
		if(!empty($pageCourante))
			$centresformation = $DALEnseignant->GetCentresFormationEnseignantParPage($login,$pageCourante);
			
		if(!empty($centresformation)){
			foreach($centresformation as $centreformation)
				$tCentres[] = new CentreFormation($centreformation[0],$centreformation[1],$centreformation[2],$centreformation[3],$centreformation[4],$centreformation[5]);
			return $tCentres;
		}
	}
	
	public function GetChefsCentre(){
		
		$DALEnseignant = new DALEnseignant();
		$chefscentre = $DALEnseignant->GetChefsCentre();
		if(!empty($chefscentre)){
			foreach($chefscentre as $chefcentre)
				$tChefs[] = new Personne($chefcentre[0],$chefcentre[1],$chefcentre[2],$chefcentre[3],$chefcentre[4],$chefcentre[5]);
			return $tChefs;
		}
	}
	
	public function GetListeCentres(){
		
		$DALEnseignant = new DALEnseignant();
		$centres = $DALEnseignant->GetListeCentres();
		if(!empty($centres)){
			foreach($centres as $centre)
				$tCentres[] = new CentreFormation($centre[0],$centre[1],$centre[2],$centre[3],$centre[4],$centre[5]);
			return $tCentres;
		}
	}
	
	public function GetInformationsChefCentre($idCentre){
		
		$DALEnseignant = new DALEnseignant();
		$chefcentre = $DALEnseignant->GetInformationsChefCentre($idCentre);
		return new Personne($chefcentre[0],$chefcentre[1],$chefcentre[2],$chefcentre[3],$chefcentre[4],$chefcentre[5]);
	}
	
	public function SupprimerCentreFormation($idCentre,$login){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerCentreFormation($idCentre,$login);
	}
			
	public function AjouterCentreFormation($login,$nomCentre,$villeCentre,$rueCentre,$cpCentre,$loginChefCentre,$nomChefCentre,$prenomChefCentre,$email,$tel,$loginEnseignant,$passwordEnseignant){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterCentreFormation($login,$nomCentre,$villeCentre,$rueCentre,$cpCentre,$loginChefCentre,$nomChefCentre,$prenomChefCentre,$email,$tel,$loginEnseignant,$passwordEnseignant);
	}
	
	public function AjouterCentreFormationExistant($idCentre,$loginEnseignant){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterCentreFormationExistant($idCentre,$loginEnseignant);
	}
	
	/*** ELEVES ***/
	
	public function GetNbGroupesEnseignant($loginEnseignantConnecte){
		
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbGroupesEnseignant($loginEnseignantConnecte);
	}
	
	public function GetGroupesEnseignantParCentre($loginEnseignantConnecte,$idCentre,$pageCourante){
	
		$DALEnseignant = new DALEnseignant();
		$listeGroupes = $DALEnseignant->GetGroupesEnseignantParCentre($loginEnseignantConnecte,$idCentre,$pageCourante);
		if(!empty($listeGroupes)){
			foreach($listeGroupes as $groupe)
				$tGroupes[] = new Groupe($groupe[0],$groupe[1],$groupe[2],$groupe[3],$groupe[4],$groupe[5]);
			return $tGroupes;
		}
	}
	
	public function GetElevesParGroupe($idGroupe){
	
		$DALEnseignant = new DALEnseignant();
		$listeEleves = $DALEnseignant->GetElevesParGroupe($idGroupe);
		if(!empty($listeEleves)){
			foreach($listeEleves as $eleve){
				$tEleves[] = new Personne($eleve[0],$eleve[1],$eleve[2],$eleve[3],$eleve[4],$eleve[5]);
			}
			return $tEleves;
		}
	}
	
	public function AjouterClasse($idCentre,$nomClasse,$anneeEtude,$tEleves,$loginEnseignant,$anneeEntree,$anneeSortie){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterClasse($idCentre,$nomClasse,$anneeEtude,$tEleves,$loginEnseignant,$anneeEntree,$anneeSortie);
	}
	
	public function AjouterUnEtudiant($idGroupe,$nomEtudiant,$prenomEtudiant,$login,$password){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterUnEtudiant($idGroupe,$nomEtudiant,$prenomEtudiant,$login,$password);
	}
	
	public function SupprimerGroupe($idGroupe,$loginEnseignant){
	
		$DALEnseignant = new DALEnseignant();
		$loginsEleves = $DALEnseignant->SupprimerGroupe($idGroupe,$loginEnseignant);
		if(!empty($loginsEleves))
			foreach($loginsEleves as $login){
				$DALEnseignant->SupprimerEleve($login);	
		}
	}
	
	public function ChargerGroupeParCentre($idCentre){
		
		$DALEnseignant = new DALEnseignant();
		$listeGroupes = $DALEnseignant->ChargerGroupeParCentre($idCentre);
		if(!empty($listeGroupes)){
			foreach($listeGroupes as $groupe)
				$tGroupes[] = new Groupe($groupe[0],$groupe[1],$groupe[2],$groupe[3],$groupe[4],$groupe[5]);
			return $tGroupes;
		}
	}
	
	public function AjouterGroupeExistant($idGroupe,$loginEnseignant){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterGroupeExistant($idGroupe,$loginEnseignant);
	}
	
	public function AjouterPlusieursEleves($idGroupe, $tableauEleves){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterPlusieursEleves($idGroupe, $tableauEleves);
	}
	
	public function AjouterNotes($nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$loginEnseignant,$date){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->AjouterNotes($nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$loginEnseignant,$date);
	}
	
	public function ModifierNotes($idDevoir,$nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$date){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->ModifierNotes($idDevoir,$nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$date);
	}
	
	public function CountNbFormationsEvalueesDuGroupe($loginEleveDuGroupe){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->CountNbFormationsEvalueesDuGroupe($loginEleveDuGroupe);
	}
	
	public function GetListeFormationsEvalueesDuGroupe($loginEleveDuGroupe,$pageCourante){
	
		$DALEnseignant = new DALEnseignant();
		$listeFormation = $DALEnseignant->GetListeFormationsEvalueesDuGroupe($loginEleveDuGroupe,$pageCourante);
		foreach($listeFormation as $formation)
			$tFormations[] = new Formation($formation[0],$formation[1],$formation[2],$formation[3]);
		return $tFormations;
	}
	
	public function CountDevoirsParFormationParGroupe($idFormation,$loginEleveDuGroupe){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->CountDevoirsParFormationParGroupe($idFormation,$loginEleveDuGroupe);
	}
			
	public function GetDevoirsParFormationParGroupe($idFormation,$pageCourante,$loginEleveDuGroupe){
		
		$DALEnseignant = new DALEnseignant();
		$listeDevoirs = $DALEnseignant->GetDevoirsParFormationParGroupe($idFormation,$pageCourante,$loginEleveDuGroupe);
		if(!empty($listeDevoirs)){
			foreach($listeDevoirs as $devoir)
				$tDevoirs[] = new Devoir($devoir[0],$devoir[1],$devoir[2],$devoir[3],$devoir[4],$devoir[5],$devoir[6]);
			return $tDevoirs;
		}
	}
	
	public function GetNotesDuDevoir($idDevoir, $listeEleves){
	
		$DALEnseignant = new DALEnseignant();
		foreach($listeEleves as $eleve){
			$tabEleve[] = $eleve;
			$note = $DALEnseignant->GetNotesDuDevoir($idDevoir, $eleve);
			$tabNote[] = new Note($note[0],$note[1],$note[2],$note[3]);
		}
		$tEleveNote['eleve'] = $tabEleve;
		$tEleveNote['note'] = $tabNote;
		return $tEleveNote;
	}
	
	public function SupprimerEleve($loginEleve){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerEleve($loginEleve);
	}
	
	public function SupprimerDevoir($idDevoir){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerDevoir($idDevoir);
	}
	
	public function GetNbDemandesInscription(){
	
		$DALEnseignant = new DALEnseignant();
		return $DALEnseignant->GetNbDemandesInscription();
	}
	
	public function GetDemandesInscriptions(){
	
		$DALEnseignant = new DALEnseignant();
		$inscriptions = $DALEnseignant->GetDemandesInscriptions();
		foreach($inscriptions as $i){
			$tDemandeurs[] = new Personne($i[0], $i[1], $i[2], $i[3], $i[4], $i[5]);
		}
		return $tDemandeurs;
	}
	
	public function DeclinerDemandeInscription($login){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->DeclinerDemandeInscription($login);
	}
	
	public function ValiderDemandeInscription($login){
		
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->ValiderDemandeInscription($login);
	}
	
	public function SupprimerAvis($loginPersonne, $idFormation){
	
		$DALEnseignant = new DALEnseignant();
		$DALEnseignant->SupprimerAvis($loginPersonne, $idFormation);
	}
}
?>