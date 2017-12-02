<?php
Autoloader::getInstance()->Autoload(array('MdlConnexion'));
class ControleurConnexion{
	
	private $tableauErreurs = array();
	
	public function __construct(){

		switch($_REQUEST['action']){
			case "SeConnecter":
								$this->SeConnecter();
								break;
			case "SeDeconnecter":
								$this->SeDeconnecter();
								break;
			default:
							if(isset($_SESSION['login'])){
								$loginPersonneConnectee = $_SESSION['login'];
								if($_SESSION['login'] == "habendaoud"){ 
									$loginSuperEnseignant = $_SESSION['login'];
									$mdlEnseignant = new ModeleEnseignant();
									$nbDemandes = $mdlEnseignant->GetNbDemandesInscription();
									if($nbDemandes > 0){ $nouvellesDemandes = true;}
								}
							}
							$actionConsulterEleves = "ConsulterMesEleves";
							if(isset($_SESSION['role'])){	
								if($_SESSION['role'] == 'enseignant'){ $roleEnseignant = $_SESSION['role']; }
								if($_SESSION['role'] == 'chefcentre'){ $roleChefCentre = $_SESSION['role']; $actionConsulterEleves = "ConsulterMesElevesCC"; }
								if($_SESSION['role'] == 'etudiant'){ $roleEtudiant = $_SESSION['role']; }
							}	
							$mdlVisiteur = new ModeleVisiteur();
							$listeForums = $mdlVisiteur->GetListeForums();	
					require('./Vue/vueErreur.php');
					break;
		}
	}
	
	public function SeConnecter(){
	
		if(isset($_POST['login'],$_POST['password'])){
			if(empty(trim($_POST['login']))){ $this->tableauErreurs[] = "Vous devez entrer votre login."; }
			if(empty(trim($_POST['password']))){ $this->tableauErreurs[] = "Vous devez entrer votre mot de passe."; }
			
			if(empty($this->tableauErreurs)){
				$mdlConnexion = new ModeleConnexion($_POST['login'], $_POST['password']);
				$personne = $mdlConnexion->WhoIsConnecting($_POST['login'], $_POST['password']);
				if(!empty($personne)){
					$mdlConnexion->SeConnecter($_POST['login'], $personne->getRole(), $personne->getNom(), $personne->getPrenom());
					$_REQUEST['action'] = "SansAction";
					$ctrlVisiteur = new ControleurVisiteur(null);
				} else { $this->tableauErreurs[] = "Identifiants incorrects"; }
			}
			
			if(!empty($this->tableauErreurs)){ require('./Vue/vueConnexion.php'); }
		}
	}
	
	public function SeDeconnecter(){
	
		unset($_SESSION['login']);
		unset($_SESSION['role']);
		unset($_SESSION['nom']);
		unset($_SESSION['prenom']);
		$_REQUEST['action'] = "SansAction";
		$ctrlVisiteur = new ControleurVisiteur(null);
	}
}

?>
		