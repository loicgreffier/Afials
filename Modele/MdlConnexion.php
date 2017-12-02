<?php
Autoloader::getInstance()->autoload(array('DALConnexion','Personne'));

class ModeleConnexion{

	public function __construct(){}
	
	public function WhoIsConnecting($login, $password){
	
		$DALConnexion = new DALConnexion();
		$personne = $DALConnexion->WhoIsConnecting($login, $password);
		if(!empty($personne))
			return new Personne($personne[0], $personne[1], $personne[2], $personne[3], $personne[4],$personne[5]);
	}
	
	public function SeConnecter($login, $role, $nom, $prenom){
	
		$_SESSION['login'] = $login;
		$_SESSION['role'] = $role;
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
	}
}
?>