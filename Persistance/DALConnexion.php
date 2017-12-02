<?php
Autoloader::getInstance()->autoload(array('BD'));

class DALConnexion{

	public function __construct(){}
	
	public function WhoIsConnecting($login, $password){
	
		$BD = BD::getInstance();
		
		$requete = "SELECT login,nom,prenom,email,numTel,role 
					FROM personne 
					WHERE (login = ? AND password = ? AND role = 'enseignant')
					OR (login = ? AND password = ? AND role = 'chefcentre')
					OR (login = ? AND password = ? AND role = 'etudiant')";
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($password, PDO::PARAM_STR),
						   '3' => array($login, PDO::PARAM_STR),
						   '4' => array($password, PDO::PARAM_STR),
						   '5' => array($login, PDO::PARAM_STR),
						   '6' => array($password, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResult($statement);
	}
}