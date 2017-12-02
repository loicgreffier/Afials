<?php
Autoloader::getInstance()->autoload(array('BD'));

class DALValidation{

	public function __construct(){}

	public function ValiderIdForum($idForum){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM forum WHERE idForum = ?";
		$parametre = array('1' => array($idForum, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idForum = $BD->getResult($statement);
		if($idForum[0] > 0){
			return true;
		}
	}
		
	public function ValiderNomForum($nomForum){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM forum WHERE intitule = ?";
		$parametre = array('1' => array($nomForum, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nomForum = $BD->getResult($statement);
		if($nomForum[0] > 0){
			return true;
		}
	}
	
	public function ValiderIdSujet($idSujet){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM sujet WHERE idSujet = ?";
		$parametre = array('1' => array($idSujet, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idSujet = $BD->getResult($statement);
		if($idSujet[0] > 0){
			return true;
		}
	}
	
	public function ValiderNomSujet($nomSujet){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM sujet WHERE titreSujet = ?";
		$parametre = array('1' => array($nomSujet, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nomForum = $BD->getResult($statement);
		if($nomForum[0] > 0){
			return true;
		}
	}
	
	public function ValiderIdMessage($idMessage){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM message WHERE idMessage = ?";
		$parametre = array('1' => array($idMessage, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idMessage = $BD->getResult($statement);
		if($idMessage[0] > 0){
			return true;
		}
	}
	
	public function ValiderIdCentre($idCentre){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM centreformation WHERE idCentre = ?";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idCentre = $BD->getResult($statement);
		if($idCentre[0] > 0){
			return true;
		}
	}
		
	public function ValiderNomCentre($nomCentre){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM centreformation WHERE nomCentre = ?";
		$parametre = array('1' => array($nomCentre, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nomCentre = $BD->getResult($statement);
		if($nomCentre[0] > 0){
			return true;
		}
	}
	
	public function ValiderLoginPersonne($login){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM personne WHERE login = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nbLogin = $BD->getResult($statement);
		if($nbLogin[0] > 0){
			return true;
		}
	}
	
	public function ValiderLoginEnseignant($login){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM personne WHERE login = ? AND role = 'enseignant'";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nbLogin = $BD->getResult($statement);
		if($nbLogin[0] > 0){
			return true;
		}
	}
	
	public function ValiderLoginEtudiant($login){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM personne WHERE login = ? AND role = 'etudiant'";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nbLogin = $BD->getResult($statement);
		if($nbLogin[0] > 0){
			return true;
		}
	}
	
	
	public function ValiderIdFormation($idFormation){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM formation WHERE idFormation = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idFormation = $BD->getResult($statement);
		if($idFormation[0] > 0){
			return true;
		}
	}
	
	public function ValiderDisponibiliteHoraire($dateDebut, $dateFin){
	
		/*$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) 
					FROM intervention 
					WHERE ? >= (SELECT dateDebut FROM intervention)
					AND ? <= (SELECT dateFin FROM intervention)
					OR ? >= (SELECT dateDebut FROM intervention) 
					AND ? <= (SELECT dateFin FROM intervention)";
		$parametre = array('1' => array($dateDebut, PDO::PARAM_STR),
						   '2' => );
		$statement = $BD->query($requete, $parametre);
		$date = $BD->getResult($statement);
		if($date[0] == 0){
			return true;
		}*/
	}
	
	public function ValiderIdIntervention($idIntervention){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM intervention WHERE idIntervention = ?";
		$parametre = array('1' => array($idIntervention, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idIntervention = $BD->getResult($statement);
		if($idIntervention[0] > 0){
			return true;
		}
	}
	
	public function ValiderNomTypeFormation($nom){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM typeformation WHERE nomTypeFormation = ?";
		$parametre = array('1' => array($nom, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$nom = $BD->getResult($statement);
		if($nom[0] > 0){
			return true;
		}
	}
	
	public function ValiderIdGroupe($idGroupe){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM groupe WHERE idGroupe = ?";
		$parametre = array('1' => array($idGroupe, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idGroupe = $BD->getResult($statement);
		if($idGroupe[0] > 0){
			return true;
		}
	}
	
	public function ValiderIdDevoir($idDevoir){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM devoir WHERE idDevoir = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idDevoir = $BD->getResult($statement);
		if($idDevoir[0] > 0){
			return true;
		}
	}
	
	public function ValiderNomFormation($nomFormation){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM formation WHERE nomFormation = ?";
		$parametre = array('1' => array($nomFormation, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nomFormation = $BD->getResult($statement);
		if($nomFormation[0] > 0){
			return true;
		}
	}
	
	public function ValiderNomDevoir($nomDevoir){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT COUNT(*) FROM devoir WHERE titreDevoir = ?";
		$parametre = array('1' => array($nomDevoir, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$nomDevoir = $BD->getResult($statement);
		if($nomDevoir[0] > 0){
			return true;
		}
	}
	
	public function ValiderNoteMaxExistante($noteMax, $idDevoir){
	
		$BD = BD::getInstance();
		$requete = "SELECT noteMax from devoir WHERE idDevoir = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$noteMaximum = $BD->getResult($statement);
		if($noteMax == $noteMaximum[0])
			return true;
	}
	
	public function ValiderNomDevoirExistant($nomDevoir, $idDevoir){
	
		$BD = BD::getInstance();
		$requete = "SELECT titreDevoir from devoir WHERE idDevoir = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		if($nomDevoir == $resultat[0])
			return true;
	}
	
	public function ValiderCoefficientDevoirExistant($coeff, $idDevoir){
	
		$BD = BD::getInstance();
		$requete = "SELECT coefficient from devoir WHERE idDevoir = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		if($coeff == $resultat[0])
			return true;
	}
	
	public function ValiderNomPrenomEnseignant($nom, $prenom){
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM personne WHERE nom = ? AND prenom = ? AND role = 'enseignant'";
		$parametre = array('1' => array($nom, PDO::PARAM_STR),
						   '2' => array($prenom, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		if($resultat[0] > 0)
			return true;
	}
	
	public function ValiderCommentaireDispo($login, $idFormation){
		
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM avis WHERE loginPersonne = ? AND idFormation = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($idFormation, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		if($resultat[0] == 0)
			return true;
	}
	
	public function ValiderMdpPersonne($mdp, $login){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM personne WHERE password = ? AND login = ?";
		$parametre = array('1' => array($mdp, PDO::PARAM_STR),
						   '2' => array($login, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		if($resultat[0] > 0)
			return true;
	}
}
?>