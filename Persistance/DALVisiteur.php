<?php
Autoloader::getInstance()->autoload(array('BD'));

class DALVisiteur{
	
	public function __construct(){}
	
	public function GetListeForums(){
		
		$BD = BD::getInstance();
		$requete = "SELECT * FROM forum ";							
		$parametre = array();
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function GetNbSujets($idForum){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM sujet WHERE idForum = ?";
		$parametre = array('1' => array($idForum, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$nbSujets = $BD->getResult($statement);
		return $nbSujets[0];
	}
	
	public function GetListeSujets($idForum,$pageCourante){
		
		$BD = BD::getInstance();
		$requete = "SELECT * FROM sujet WHERE idForum = ? ORDER BY dateDernierMessage desc LIMIT ?,3";	
		$position = ($pageCourante-1)*3;	
		$parametre = array('1' => array($idForum, PDO::PARAM_INT),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}	
		
	public function GetListeMessages($idSujet){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM message where idSujet = ?";							
		$parametre = array('1' => array($idSujet, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterDemandeur($nom, $prenom, $email, $tel, $pseudo, $password){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO personne (login, password, nom, prenom, email, numTel, role) VALUES (?,?,?,?,?,?,'demandeur')";		
		$parametre = array('1' => array($pseudo, PDO::PARAM_STR),
						   '2' => array($password, PDO::PARAM_STR),
						   '3' => array($nom, PDO::PARAM_STR),
						   '4' => array($prenom, PDO::PARAM_STR),
						   '5' => array($email, PDO::PARAM_STR),
						   '6' => array($tel, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
}
