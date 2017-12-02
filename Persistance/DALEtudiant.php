<?php
Autoloader::getInstance()->autoload(array('BD','Formation','CentreFormation'));

class DALEtudiant{
	
	public function __construct(){}
	
	public function AjouterSujet($idForum, $titreSujet, $messageSujet, $login){
	
		$BD = BD::getInstance();

		$requete = "INSERT INTO sujet (titreSujet, loginPersonne, idForum) VALUES (?, ?, ?)";					
		$parametre = array('1' => array($titreSujet, PDO::PARAM_STR),
						   '2' => array($login, PDO::PARAM_STR),
						   '3' => array($idForum, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		
		$requete2 = "SELECT MAX(idSujet) FROM sujet WHERE titreSujet = ? AND loginPersonne = ? AND idForum = ?";
		$parametre2 = array('1' => array($titreSujet, PDO::PARAM_STR),
						    '2' => array($login, PDO::PARAM_STR),
						    '3' => array($idForum, PDO::PARAM_INT));
		$statement2 = $BD->query($requete2, $parametre2);
		$idSujet = $BD->getResult($statement2);
		
		$requete3 = "INSERT INTO message (message, idSujet, loginPersonne) VALUES (?, ?, ?)";					
		$parametre3 = array('1' => array($messageSujet, PDO::PARAM_STR),
						    '2' => array($idSujet[0], PDO::PARAM_INT),
						    '3' => array($login, PDO::PARAM_STR));
		$statement3 = $BD->query($requete3, $parametre3);
	}
	
	public function AjouterMessage($message, $idSujet, $login){
		echo $message, $idSujet, $login;
		$BD = BD::getInstance();
		$requete = "INSERT INTO message (message, idSujet, loginPersonne) VALUES (?, ?, ?)";					
		$parametre = array('1' => array($message, PDO::PARAM_STR),
						    '2' => array($idSujet, PDO::PARAM_INT),
						    '3' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		
		$requete2 = "UPDATE sujet SET nbReponses = nbReponses + 1 WHERE idSujet = ?";
		$parametre2 = array('1' => array($idSujet, PDO::PARAM_INT));
		$statement2 = $BD->query($requete2, $parametre2);
		
		$requete3 = "UPDATE sujet SET dateDernierMessage = ? WHERE idSujet = ?";
		$parametre3 = array('1' => array(date("Y-m-d H:i:s"), PDO::PARAM_INT),
							'2' => array($idSujet, PDO::PARAM_INT));
		$statement3 = $BD->query($requete3, $parametre3);
	}
	
	public function GetFormationById($idFormation){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM formation WHERE idFormation = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function GetAvisFormationById($idFormation){
	
		$BD = BD::getInstance();
		$requete = "SELECT P.login, P.nom, P.prenom, P.email, P.numTel, P.role, A.note, A.commentaire, F.idFormation, F.nomFormation, F.descriptif, F.nomTypeFormation
					FROM avis A, personne P, formation F
					WHERE A.idFormation = ?
					AND P.login = A.loginPersonne 
					AND F.idFormation = A.idFormation";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterAvis($note, $commentaire, $idformation, $login){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO avis (loginPersonne, idFormation, note, commentaire) VALUES (?,?,?,?)";
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($idformation, PDO::PARAM_INT),
						   '3' => array($note, PDO::PARAM_INT),
						   '4' => array($commentaire, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
	
	public function CountNbFormationsEvalueesEleve($loginEleve){
		
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(DISTINCT(idFormation))
					FROM devoir D, avoirnote AN
					WHERE AN.idDevoir = D.idDevoir
					AND AN.loginPersonne = ?";
		$parametre = array('1' => array($loginEleve, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbFormationsEvaluees = $BD->getResult($statement);
		return $nbFormationsEvaluees[0];
	}
	
	public function GetMesFormationsEvaluees($loginEleve,$pageCourante){
		
		$BD = BD::getInstance();
		$requete = "SELECT F.idFormation, nomFormation, descriptif, nomTypeFormation
					FROM formation F, devoir D, avoirnote AN
					WHERE F.idFormation = D.idFormation
					AND AN.idDevoir = D.idDevoir
					AND AN.loginPersonne = ?	
					GROUP BY F.idFormation
					LIMIT ?,20";			
		$position = ($pageCourante-1)*20;
		$parametre = array('1' => array($loginEleve, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
		
	public function CountDevoirsParFormationEleve($idFormation,$loginEleve){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) 
					FROM devoir D, avoirnote AN 
					WHERE D.idDevoir = AN.idDevoir 
					AND D.idFormation = ? 
					AND AN.loginPersonne = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT),
						   '2' => array($loginEleve, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbDevoirs = $BD->getResult($statement);
		return $nbDevoirs[0];
	}
	
	public function GetDevoirsParFormationEleve($idFormation,$loginEleve){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM devoir D, avoirnote AN 
					WHERE D.idFormation = ? 
					AND D.idDevoir = AN.idDevoir 
					AND AN.loginPersonne = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT),
						   '2' => array($loginEleve, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetNoteDuDevoir($idDevoir, $loginEleve){
	
		$BD = BD::getInstance();
		$requete = "SELECT idNote, note, loginPersonne, idDevoir FROM avoirnote WHERE idDevoir = ? AND loginPersonne = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT),
						   '2' => array($loginEleve, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResult($statement);
	}
	
	public function GetInformationsPersonne($login){
		
		$BD = BD::getInstance();
		$requete = "SELECT login, nom, prenom, email, numTel, role FROM personne WHERE login = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResult($statement);
	}
	
	public function ModifierMdp($login, $mdp){
	
		$BD = BD::getInstance();
		$requete = "UPDATE personne SET password = ? WHERE login = ?";
		$parametre = array('1' => array($mdp, PDO::PARAM_STR),
						   '2' => array($login, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
	
	public function ModifierInformations($login, $nom, $prenom, $email, $tel){
	
		$BD = BD::getInstance();
		$requete = "UPDATE personne SET nom = ?, prenom = ?, email = ?, numTel = ? WHERE login = ?";
		$parametre = array('1' => array($nom, PDO::PARAM_STR),
						   '2' => array($prenom, PDO::PARAM_STR),
						   '3' => array($email, PDO::PARAM_STR),
						   '4' => array($tel, PDO::PARAM_STR), 
						   '5' => array($login, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
}
?>