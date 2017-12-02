<?php
Autoloader::getInstance()->autoload(array('BD'));

class DALChefCentre{
	
	public function __construct(){}
	
	public function GetNbCentresFormationChefCentre($loginEnseignant){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM centreformation WHERE loginPersonne = ?";
		$parametre = array('1' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$NbCentresFormationEnseignant = $BD->getResult($statement);
		return $NbCentresFormationEnseignant[0];
	}
	
	public function GetCentresFormationChefCentre($login){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM centreformation WHERE loginPersonne = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetCentresFormationChefCentreParPage($login,$pageCourante){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM centreformation WHERE loginPersonne = ? LIMIT ?,20";
		$position = ($pageCourante-1)*20;
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetNbGroupes($idCentre){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM groupe WHERE idCentre = ?";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		$nbGroupes = $BD->getResult($statement);
		return $nbGroupes[0];
	}
	
	public function SupprimerGroupeCC($idGroupe){
	
		$BD = BD::getInstance();
		
		$requete2 = "SELECT loginPersonne 
					 FROM appartenir A, personne P 
					 WHERE idGroupe = ?
					 AND A.loginPersonne = P.login
					 AND P.role = 'etudiant'";
		$parametre2 = array('1' => array($idGroupe,PDO::PARAM_INT));
		$statement2 = $BD->query($requete2,$parametre2);
		$logins = $BD->getResults($statement2);
		foreach($logins as $login)
				$tLogins[] = $login[0];
		
		$requete = "DELETE FROM appartenir WHERE idGroupe = ?";
		$parametre = array('1' => array($idGroupe, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		
		$requete5 = "DELETE FROM groupe WHERE idGroupe = ?";
		$parametre5 = array('1' => array($idGroupe, PDO::PARAM_INT));
		$statement = $BD->query($requete5,$parametre5);
		
		return $tLogins;
	}
}
?>