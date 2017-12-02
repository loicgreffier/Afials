<?php 
session_start();
Autoloader::getInstance()->Autoload(array('CtrlConnexion','CtrlEnseignant','CtrlEtudiant', 'CtrlVisiteur', 'CtrlChefCentre',
										  'MdlEnseignant', 'MdlEtudiant', 'MdlChefCentre'));

class FrontControleur{

	private $tableauErreurs = array();
	
	public function __construct(){
		
		try{
			
			$tableauActionsConnexion = array('SeConnecter','SeDeconnecter');
			$tableauActionsEtudiant = array('AjouterSujet','AjouterMessage','ConsulterAvis','AjouterAvis','ConsulterMesNotes','GererMonCompte','ModifierMdp','ModifierInformations');
			$tableauActionsChefCentre = array('ConsulterMesElevesCC','AjouterClasseCC','AjouterUnEtudiantCC','SupprimerGroupeCC','SupprimerEleveCC');
			$tableauActionsEnseignant = array('ConsulterMesFormations','AjouterFormation','AjouterTypeFormation','SupprimerFormation', 'ModifierFormation',
											  'SupprimerForum','SupprimerSujet','SupprimerMessage', 'AjouterForum','SupprimerAvis',
											  'ConsulterAgenda','AjouterIntervention','SupprimerIntervention','ViderAgenda',
											  'ConsulterMesCentresFormation','SupprimerCentreFormation','AjouterCentreFormation','ModifierCentreFormation','AjouterCentreFormationExistant',
											  'ConsulterMesEleves','AjouterClasse','AjouterUnEtudiant','SupprimerGroupe','SupprimerEleve','AjouterGroupeExistant','AjouterPlusieursEleves',
											  'AjouterNotes','ConsulterNotes','ModifierNotes','SupprimerDevoir',
											  'ConsulterDemandesInscription','DeclinerDemandeInscription','ValiderDemandeInscription');
			
			if(!isset($_REQUEST['action'])){
				$_REQUEST['action'] = "SansAction";
			}
			
			if(in_array($_REQUEST['action'], $tableauActionsConnexion)){
				$ctrlConnexion = new ControleurConnexion();
			}
			else if(in_array($_REQUEST['action'], $tableauActionsChefCentre)){
				
				$mdlChefCentre = new ModeleChefCentre();
				if($mdlChefCentre->isChefCentre()){	
					$ctrlChefCentre = new ControleurChefCentre(null);
				} else { 	
					$this->tableauErreurs[] = 'Vous avez besoin d\'être connecté pour accéder à cette page';
					$_REQUEST['action'] = "AfficherVueConnexion";
					$ctrlVisiteur = new ControleurVisiteur($this->tableauErreurs);
				}
			}
			else if(in_array($_REQUEST['action'], $tableauActionsEnseignant)){
				
				$mdlEnseignant = new ModeleEnseignant();
				if($mdlEnseignant->isEnseignant()){	
					$ctrlEnseignant = new ControleurEnseignant(null);
				} else if(($_REQUEST['action'] == 'ConsulterNotes')){ 
					$mdlChefCentre = new ModeleChefCentre();
					if($mdlChefCentre->isChefCentre())
						$ctrlEnseignant = new ControleurEnseignant(null);
				} else {
					if(isset($_SESSION['login'])){ $this->tableauErreurs[] = "Vous devez être inscrit en temps qu'<span style='color: #FF4B4B;'>enseignant </span> pour accéder à cette page."; 
					} else { $this->tableauErreurs[] = 'Vous avez besoin d\'être connecté pour accéder à cette page.'; }
					$_REQUEST['action'] = "AfficherVueConnexion";
					$ctrlVisiteur = new ControleurVisiteur($this->tableauErreurs);
				}
			}
			
			else if(in_array($_REQUEST['action'], $tableauActionsEtudiant)){
																						
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEnseignant = new ModeleEnseignant();	
				$mdlChefCentre = new ModeleChefCentre();
				if($mdlEtudiant->isEtudiant() || $mdlEnseignant->isEnseignant() || $mdlChefCentre->isChefCentre()){													
					$ctrlEtudiant = new ControleurEtudiant(null);
				} else { 
					$this->tableauErreurs[] = 'Vous avez besoin d\'être connecté pour accéder à cette page';
					$_REQUEST['action'] = "AfficherVueConnexion";
					$ctrlVisiteur = new ControleurVisiteur($this->tableauErreurs);
				}								
			}
									
			else { $ctrlVisiteur = new ControleurVisiteur(null); }
			
		} catch (Exception $e) { 
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
		}
	}
}
?>