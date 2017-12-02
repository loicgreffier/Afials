<?php
Autoloader::getInstance()->autoload(array('MdlValidation'));

class Validation{
            
	public static function ValiderIdForum($idForum){
		
		if(!empty(trim($idForum)) && is_numeric($idForum)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdForum($idForum)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderNomForum($nomForum){
		
		if(!empty(trim($nomForum)) && is_string($nomForum)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomForum($nomForum)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
		
	public static function ValiderIdSujet($idSujet){
		
		if(!empty(trim($idSujet)) && is_numeric($idSujet)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdSujet($idSujet)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderNomSujet($nomSujet){
	
		if(!empty(trim($nomSujet)) && is_string($nomSujet)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomSujet($nomSujet)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdMessage($idMessage){
	
		if(!empty(trim($idMessage)) && is_numeric($idMessage)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdMessage($idMessage)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdPage($nombre, $pagemax){
	
		if(isset($nombre) && !empty(trim($nombre)) && is_numeric($nombre) && $nombre <= $pagemax && $nombre > 0){
			return true;
		} else { throw new Exception; }
	}
	
	public static function ValiderIdCentre($idCentre){
	
		if(!empty(trim($idCentre)) && is_numeric($idCentre)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdCentre($idCentre)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdCentreExistant($idCentre){
	
		if(!empty(trim($idCentre)) && is_numeric($idCentre)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdCentre($idCentre)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception('Erreur, veuillez selectionner un centre de formation'); }
	}
	
	public static function ValiderNomCentre($nomCentre){
	
		if(!empty(trim($nomCentre)) && is_string($nomCentre)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomCentre($nomCentre)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderLoginPersonne($login){
		
		if(!empty(trim($login)) && is_string($login)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderLoginPersonne($login)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderLoginEnseignant($login){
	
		if(!empty(trim($login)) && is_string($login)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderLoginEnseignant($login)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderLoginEtudiant($login){
	
		if(!empty(trim($login)) && is_string($login)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderLoginEtudiant($login)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdFormation($idFormation){
	
		if(!empty(trim($idFormation)) && is_numeric($idFormation)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdFormation($idFormation)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdFormationExistante($idFormation){
	
		if(!empty(trim($idFormation)) && is_numeric($idFormation)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdFormation($idFormation)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception('Erreur, aucune formation renseignée'); }
	}
	
	public static function ValiderNomFormationExistant($nomFormation){
	
		if(!empty(trim($nomFormation)) && is_string($nomFormation)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomFormation($nomFormation)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdDevoir($idDevoir){
	
		if(!empty(trim($idDevoir)) && is_numeric($idDevoir)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdDevoir($idDevoir)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderDisponibiliteHoraire($dateDebut, $dateFin, $jourd, $moisd, $anneed, $jourf, $moisf, $anneef){
		
		if(checkdate($moisd,$jourd,$anneed)){
			if(checkdate($moisf, $jourf, $anneef)){
				$mdlValidation = new ModeleValidation();
				if($mdlValidation->ValiderDisponibiliteHoraire($dateDebut,$dateFin)){
					return true;
				} else { throw new Exception('Date non disponible'); }
			} else { throw new Exception('Date de fin invalide'); }
		} else { throw new Exception('Date de début invalide'); }
	}
	
	public static function ValiderIdIntervention($idIntervention){
	
		if(!empty(trim($idIntervention)) && is_numeric($idIntervention)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdIntervention($idIntervention)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderNomTypeFormation($nom){
	
		if(!empty(trim($nom))){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomTypeFormation($nom)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception('Type de formation manquant'); }
	}
	
	public static function ValiderDisponibiliteLoginPersonne($pseudo){
	
		$mdlValidation = new ModeleValidation();
		if($mdlValidation->ValiderLoginPersonne($pseudo)){
			return true;
		} else return false;
	}
	
	public static function ValiderIdGroupe($idGroupe){
	
		if(!empty(trim($idGroupe)) && is_numeric($idGroupe)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdGroupe($idGroupe)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderIdGroupeExistant($idGroupe){
	
		if(!empty(trim($idGroupe)) && is_numeric($idGroupe)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderIdGroupe($idGroupe)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception('Erreur, veuillez selectionner un groupe'); }
	}
	
	public static function ValiderNoteMaxExistante($noteMax, $idDevoir){
		
		if(!empty(trim($noteMax)) && is_numeric($noteMax)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNoteMaxExistante($noteMax, $idDevoir)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderNomDevoirExistant($nomDevoir, $idDevoir){
	
		if(!empty(trim($nomDevoir)) && is_string($nomDevoir) && !empty($idDevoir) && is_numeric($idDevoir)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomDevoirExistant($nomDevoir, $idDevoir)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderCoefficientDevoirExistant($coeff, $idDevoir){
	
		if(!empty(trim($coeff)) && is_numeric($coeff) && !empty($idDevoir) && is_numeric($idDevoir)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderCoefficientDevoirExistant($coeff, $idDevoir)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderNomPrenomEnseignant($nom, $prenom){
	
		if(!empty(trim($nom)) && !empty($prenom)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderNomPrenomEnseignant($nom, $prenom)){
				return true;
			} else { throw new Exception; }
		} else { throw new Exception; }
	}
	
	public static function ValiderDejaCommenter($login, $idFormation){
	
		if(!empty($login) && !empty($idFormation)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderCommentaireDispo($login, $idFormation)){
				return true;
			} else { throw new Exception('Vous avez déjà commenté cette formation'); }
		} else { throw new Exception; }
	}
	
	public static function ValiderMdpPersonne($mdp, $login){
	
		if(!empty($mdp)){
			$mdlValidation = new ModeleValidation();
			if($mdlValidation->ValiderMdpPersonne($mdp, $login)){
				return true;
			} else { throw new Exception('Mot de passe actuel incorrect'); }
		} else { throw new Exception('Mot de passe actuel vide'); }
	}
	
	/*** EXPRESSION REGULIERE ***/
	public static function ValiderTitreSujet($titreSujet){
	
		if(!empty(trim($titreSujet))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,100}$/ ", $titreSujet)){
				return true;
			} else { throw new Exception('Titre invalide'); }
		} else { throw new Exception('Titre vide'); }
	}
	
	public static function ValiderMessage($message){
	
		if(!empty(trim($message))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,2000}$/ ",$message)){
				return true;
			} else { throw new Exception('Message invalide'); }
		} else { throw new Exception('Message vide'); }
	}
	
	public static function ValiderNomFormation($nom){
	
		if(!empty(trim($nom))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,50}$/ ",$nom)){
				return true;
			} else { throw new Exception('Nom de formation invalide'); }
		} else { throw new Exception('Nom de formation vide'); }
	}
	
	public static function ValiderNouveauTypeFormation($type){
	
		if(!empty(trim($type))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$type)){
				return true;
			} else { throw new Exception('Type invalide'); }
		} else { throw new Exception('Type vide'); }
	}
	
	public static function ValiderDescriptifFormation($type){
	
		if(!empty(trim($type))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,1000}$/ ",$type)){
				return true;
			} else { throw new Exception('Description invalide'); }
		} else { throw new Exception('Description vide'); }
	}
	
	public static function ValiderSalle($salle){
	
		if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,10}$/ ",$salle)){
			return true;
		} else { throw new Exception('Salle invalide'); }
	}
	
	public static function ValiderNomCentreFormation($nom){
	
		if(!empty(trim($nom))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,60}$/ ",$nom)){
				return true;
			} else { throw new Exception('Nom du centre invalide'); }
		} else { throw new Exception('Nom du centre vide'); }
	}
	
	public static function ValiderVilleCentre($ville){
	
		if(!empty(trim($ville))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,60}$/ ",$ville)){
				return true;
			} else { throw new Exception('Ville invalide'); }
		} else { throw new Exception('Ville vide'); }
	}
	
	public static function ValiderRueCentre($rue){
	
		if(!empty(trim($rue))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,80}$/ ",$rue)){
				return true;
			} else { throw new Exception('Rue invalide'); }
		} else { throw new Exception('Rue vide'); }
	}
	
	public static function ValiderCodePostalCentre($cp){
	
		if(!empty(trim($cp))){
			if(preg_match(" /^[0-9]{5}$/ ",$cp)){
				return true;
			} else { throw new Exception('Code postal invalide'); }
		} else { throw new Exception('Code postal vide'); }
	}
	
	public static function ValiderNomChefCentre($nom){
	
		if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nom)){
			return true;
		} else { throw new Exception('Nom du chef invalide'); }
	}
		
	public static function ValiderPrenomChefCentre($prenom){
	
		if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$prenom)){
			return true;
		} else { throw new Exception('Prenom du chef invalide'); }
	}
	
	public static function ValiderEmailChefCentre($email){
	
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		} else { throw new Exception('Email du chef invalide'); }
	}
	
	public static function ValiderTelephoneChefCentre($telephone){
	
		if(preg_match(" /^[0-9]{10}$/ ",$telephone)){
			return true;
		} else { throw new Exception('Numero de telephone invalide'); }
	}
	
	public static function ValiderNomGroupe($classe){
	
		if(!empty($classe)){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$classe)){
				return true;
			} else { throw new Exception('Nom de classe invalide'); }
		} else { throw new Exception('Nom de classe vide'); }
	}
	
	public static function ValiderFichierAjoutClasse($fichier, $tailleMaxFichier){
		
		if(!empty($fichier)){
			if($fichier['size'] < $tailleMaxFichier){
				return true;
			} else { throw new Exception('Fichier trop volumineux'); }
		} else { throw new Exception('Fichier manquant'); }
	}
	
	public static function ValiderNomEleve($nomPrenom, $ligneFichier){
		
		if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nomPrenom)){
			return true;
		} else if (!empty($ligneFichier)) { throw new Exception("Nom invalide dans le fichier ligne ".$ligneFichier); 
		} else { throw new Exception('Nom invalide'); }
	}
	
	public static function ValiderPrenomEleve($nomPrenom, $ligneFichier){
		
		if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nomPrenom)){
			return true;
		} else if (!empty($ligneFichier)) { throw new Exception("Prénom invalide dans le fichier ligne ".$ligneFichier); 
		} else { throw new Exception('Prénom invalide'); }
	}
	
	public static function ValiderNote($note, $noteMax){
	
		if(!empty($noteMax)){
			if($note >= 0 && $note <= $noteMax){
				return true;
			} else { throw new Exception("Erreur, les notes doivent être comprises entre 0 et ".$noteMax); }
		}
	}
	
	public static function ValiderNomDevoir($nomDevoir){
	
		if(!empty($nomDevoir)){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nomDevoir)){
				return true;
			} else { throw new Exception('Intitule du devoir invalide'); }
		} else { throw new Exception('Intitule du devoir vide'); }
	}
	
	public static function ValiderNoteMaximumDevoir($note){
	
		if(!empty($note)){
			if($note > 0){
				return true;
			} else { throw new Exception('La note doit être positive'); }
		} else { throw new Exception('Note maximume manquante'); }
	}
	
	public static function ValiderCoefficientDevoir($coeff){
	
		if(!empty($coeff)){
			if($coeff > 0){
				return true;
			} else { throw new Exception('Le coefficient doit être positif'); }
		} else { throw new Exception('Coefficient manquant'); }
	}
	
	public static function ValiderNoteAvis($note){
	
		if($note >= 0 && $note <=5){
			return true;
		} else { throw new Exception; }
	}
	
	public static function ValiderCommentaireAvis($com){
	
		if(!empty(trim($com))){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,200}$/ ",$com)){
				return true;
			} else { throw new Exception('Commentaire invalide ou trop volumineux'); }
		} else { throw new Exception('Commentaire vide'); }
	}
	
	public static function ValiderTitreForum($titre){
	
		if(!empty($titre)){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,60}$/ ",$titre)){
				return true;
			} else { throw new Exception('Nom du forum invalide'); }
		} else { throw new Exception('Nom du forum vide'); }
	}
	
	public static function ValiderNouveauMdpPersonne($nouveauMdp, $nouveauMdp2){
	
		if(!empty($nouveauMdp) && !empty($nouveauMdp2)){
			if(strcmp($nouveauMdp, $nouveauMdp2)==0){
				if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,60}$/ ",$nouveauMdp) && preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,60}$/ ",$nouveauMdp2)){
					return true;
				} else { throw new Exception('Nouveau mot de passe invalide'); }
			} else { throw new Exception('Confirmation du nouveau mot de passe incorrecte'); }
		} else { throw new Exception('Nouveau mot de passe manquant'); }
	}
	
	public static function ValiderNom($nom){
	
		if(!empty($nom)){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nom)){
				return true;
			} else { throw new Exception('Nom invalide'); }
		} else { throw new Exception('Nom manquant'); }
	}
	
	public static function ValiderPrenom($nom){
	
		if(!empty($nom)){
			if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{1,40}$/ ",$nom)){
				return true;
			} else { throw new Exception('Prenom invalide'); }
		} else { throw new Exception('Prenom manquant'); }
	}
	
	public static function ValiderEmail($email){
	
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		} else { throw new Exception('Email invalide'); }
	}
	
	public static function ValiderTelephone($telephone){
	
		if(preg_match(" /^[0-9]{10}$/ ",$telephone)){
			return true;
		} else { throw new Exception('Numero de telephone invalide'); }
	}
}
?>