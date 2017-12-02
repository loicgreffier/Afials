<?php
Autoloader::getInstance()->Autoload(array('MdlVisiteur','Validation'));

class ControleurVisiteur{

	private $tableauErreurs = array();

	public function __construct($tableauErreursControleurs){
		
		if(!empty($tableauErreursControleurs)){
			$this->tableauErreurs['erreurAfficherPopup'] = $tableauErreursControleurs['erreurAfficherPopup'];
			unset($tableauErreursControleurs['erreurAfficherPopup']);
			foreach($tableauErreursControleurs as $erreur)
				$this->tableauErreurs[] = $erreur;
		}	
			
		switch($_REQUEST['action']){
			case "SansAction":
								$this->SansAction();
								break;
			case "AfficherVueConnexion":
								$this->AfficherVueConnexion();
								break;
			case "ConsulterPageForum":
								$this->ConsulterPageForum();
								break;
			case "ConsulterForum":
								$this->ConsulterForum();
								break;
			case "ConsulterSujet":
								$this->ConsulterSujet();
								break;
			case "ConsulterPageFormations":
								$this->ConsulterPageFormations();
								break;
			case "ConsulterMentionsLegales":
								$this->ConsulterMentionsLegales();
								break;
			case "ConsulterContact":
								$this->ConsulterContact();
								break;
			case "ConsulterAPropos":
								$this->ConsulterAPropos();
								break;
			case "ChangerCouleurSite":
								$this->ChangerCouleurSite();
								break;
			case "DemanderInscription":
								$this->DemanderInscription();
								break;
			case "EnvoyerDemandeInscription":
								$this->EnvoyerDemandeInscription();
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

	public function SansAction(){ 
	
		if(isset($_SESSION['login'])){
			$loginPersonneConnectee = $_SESSION['login'];
			$prenomPersonneConnectee = $_SESSION['nom'];
			$nomPersonneConnectee = $_SESSION['prenom'];
			$rolePersonneConnectee = $_SESSION['role'];
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
		require('./Vue/vueAccueil.php'); 
	}
	
	public function AfficherVueConnexion(){ 
	
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
		require('./Vue/vueConnexion.php'); 
	}
	
	public function ConsulterForum(){
	
		if(isset($_GET['idForum'], $_GET['nomForum'])){
			Validation::ValiderIdForum($_GET['idForum']);
			Validation::ValiderNomForum($_GET['nomForum']);
			$idForumActuel = $_GET['idForum'];
			$nomForumActuel = $_GET['nomForum'];
			
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
						
			$nbSujets = $mdlVisiteur->GetNbSujets($_GET['idForum']);
			if(isset($_GET['pageCourante'])){
				$pageCourante = $_GET['pageCourante'];
				$pageMax = ceil($nbSujets/3);
				Validation::ValiderIdPage($pageCourante,$pageMax);
			} else { $pageCourante = 1; }
			
			if($nbSujets != 0)
				$listeSujets = $mdlVisiteur->GetListeSujets($_GET['idForum'],$pageCourante);
	
			$nomForum = $_GET['nomForum'];
			$idForum = $_GET['idForum'];
			require('./Vue/vuesForum/vueSujets.php');
		}
	}
	
	public function ConsulterSujet(){
	
		if(isset($_GET['idSujet'],$_GET['nomSujet'],$_GET['idForum'],$_GET['nomForum'],$_GET['pageCouranteForum'])){
		
			Validation::ValiderIdSujet($_GET['idSujet']);
			Validation::ValiderNomSujet($_GET['nomSujet']);
			Validation::ValiderIdForum($_GET['idForum']);
			Validation::ValiderNomForum($_GET['nomForum']);
			$idForumDuSujet = $_GET['idForum'];
			$nomForumDuSujet = $_GET['nomForum'];
			$pageCouranteDuForumDuSujet = $_GET['pageCouranteForum'];
			$idSujet = $_GET['idSujet'];
			$nomSujet = $_GET['nomSujet'];
			
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

			$listeMessages = $mdlVisiteur->GetListeMessages($_GET['idSujet']);
			$nomSujet = $_GET['nomSujet'];
			$idSujet = $_GET['idSujet'];
			require('./Vue/vuesForum/vueMessages.php');
		}
	}
	
	public function ConsulterPageFormations(){
	
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
		
		$mdlEnseignant = new ModeleEnseignant();
		$nbEnseignant = $mdlEnseignant->GetNbEnseignant();
		if(isset($_GET['pageCourante'])){
			$pageMax = ceil($nbEnseignant/30);
			$pageCourante = Validation::ValiderIdPage($_GET['pageCourante'], $pageMax);
		} else { $pageCourante = 1; }
			
		if($nbEnseignant != 0)
			$listeEnseignants = $mdlEnseignant->GetListeEnseignants($pageCourante);
			
			if(isset($_GET['loginEnseignant'],$_GET['nomEnseignant'],$_GET['prenomEnseignant'])){
				Validation::ValiderLoginEnseignant($_GET['loginEnseignant']);
				$loginPersonneConnecteeEnseignant = $_GET['loginEnseignant'];
				$nomEnseignant = $_GET['nomEnseignant'];
				$prenomEnseignant = $_GET['prenomEnseignant'];
			} else { 
				$loginPersonneConnecteeEnseignant = $listeEnseignants[0]->getLogin();
				$nomEnseignant = $listeEnseignants[0]->getNom();	
				$prenomEnseignant = $listeEnseignants[0]->getPrenom();
			}
			
			$nbFormationEnseignant = $mdlEnseignant->GetNbFormationEnseignant($loginPersonneConnecteeEnseignant);
			if(isset($_GET['pageCouranteFormation'])){
				$pageMax = ceil($nbFormationEnseignant/5);
				$pageCouranteFormation = Validation::ValiderIdPage($_GET['pageCouranteFormation'], $pageMax);
			} else { $pageCouranteFormation = 1; }
			
			if($nbFormationEnseignant != 0)
				$formationsEnseignant = $mdlEnseignant->GetFormationsEnseignant($loginPersonneConnecteeEnseignant,$pageCouranteFormation);
		require('./Vue/vueFormations.php');
	}
	
	public function ConsulterMentionsLegales(){
	
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
		require('./Vue/vueMentionsLegales.php');
	}
	
	public function ConsulterContact(){
	
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
		require('./Vue/vueContact.php');
	}
	
	public function ConsulterAPropos(){

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
		require('./Vue/vueAPropos.php');
	}	
	
	public function ConsulterPageForum(){
	
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
		require('./Vue/vuesForum/vuePageForum.php');
	}
	
	public function ChangerCouleurSite(){
	
		if(isset($_GET['couleur'])){
			setcookie('couleurSite', $_GET['couleur'], time() + 365*24*3600, null, null, false, true); 
			$_REQUEST['action'] = "SansAction";
			new ControleurVisiteur(null);
		}
	}
	
	public function DemanderInscription(){
	
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
		require('./Vue/vueDemandeInscription.php');
	}
	
	public function EnvoyerDemandeInscription(){
	
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
		
		if(isset($_POST['nomDemandeur'], $_POST['prenomDemandeur'], $_POST['emailDemandeur'], $_POST['telDemandeur'])){
		
			try{
				Validation::ValiderNom($_POST['nomDemandeur']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderPrenom($_POST['prenomDemandeur']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			if(!empty($_POST['emailDemandeur'])){
				try{
					Validation::ValiderEmail($_POST['emailDemandeur']);
				} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			} else { $this->tableauErreurs[] = "Email manquant"; }
			
			if(!empty($_POST['telDemandeur'])){
				try{
					Validation::ValiderTelephone($_POST['telDemandeur']);
					$_POST['telDemandeur'] = Nettoyage::CreerNumeroTelephone($_POST['telDemandeur']);
				} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			$pseudo = strtolower(substr($_POST['prenomDemandeur'],0,2).$_POST['nomDemandeur']);
			$y = 2;
			while(Validation::ValiderDisponibiliteLoginPersonne($pseudo)){
				$pseudo = strtolower(substr($_POST['prenomDemandeur'],0,2).$_POST['nomDemandeur']).$y;
				$y++;
			}
			$password = $pseudo;
			
			if(empty($this->tableauErreurs)){
				$mdlVisiteur = new ModeleVisiteur();
				$mdlVisiteur->AjouterDemandeur($_POST['nomDemandeur'], $_POST['prenomDemandeur'], $_POST['emailDemandeur'], $_POST['telDemandeur'], $pseudo, $password);
				$ajouter = true;
			}
			require('./Vue/vueDemandeInscription.php');
		}
	}
}