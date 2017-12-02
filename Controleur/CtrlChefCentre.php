<?php
Autoloader::getInstance()->Autoload(array('MdlChefCentre', 'Validation'));

class ControleurChefCentre{

	private $tableauErreurs = array();

	public function __construct($tableauErreursControleurs){
		
		if(!empty($tableauErreursControleurs)){
			$this->tableauErreurs['erreurAfficherPopup'] = $tableauErreursControleurs['erreurAfficherPopup'];
			unset($tableauErreursControleurs['erreurAfficherPopup']);
			foreach($tableauErreursControleurs as $erreur)
				$this->tableauErreurs[] = $erreur;
		}	
					
		switch($_REQUEST['action']){
			case "ConsulterMesElevesCC":
								$this->ConsulterMesElevesCC();
								break;
			case "AjouterClasseCC": 
								$this->AjouterClasseCC();
								break;
			case "AjouterUnEtudiantCC":
								$this->AjouterUnEtudiantCC();
								break;
			case "SupprimerGroupeCC":
								$this->SupprimerGroupeCC();
								break;
			case "AjouterPlusieursElevesCC":
								$this->AjouterPlusieursElevesCC();
								break;
			case "SupprimerEleveCC":
								$this->SupprimerEleveCC();
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
		
	public function ConsulterMesElevesCC(){
		
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
		
		$mdlChefCentre = new ModeleChefCentre();
		$mdlEnseignant = new ModeleEnseignant();
		$nbCentresFormation = $mdlChefCentre->GetNbCentresFormationChefCentre($loginPersonneConnectee);
		
		if(isset($_GET['pageCouranteCentresFormation'])){
			$pageMax = ceil($nbCentresFormation/20);
			Validation::ValiderIdPage($_GET['pageCouranteCentresFormation'], $pageMax);
		} else { $_GET['pageCouranteCentresFormation'] = 1; }
		
		if($nbCentresFormation > 0){
			$centresFormation = $mdlChefCentre->GetCentresFormationChefCentre($loginPersonneConnectee,$_GET['pageCouranteCentresFormation']);
			if(isset($_GET['idCentreSelect'],$_GET['nomCentreSelect'],$_GET['cp'])){
				Validation::ValiderIdCentre($_GET['idCentreSelect']);
				Validation::ValiderNomCentre($_GET['nomCentreSelect']);
				Validation::ValiderCodePostalCentre($_GET['cp']);
				$idCentreSelect = $_GET['idCentreSelect'];
				$nomCentreSelect = $_GET['nomCentreSelect'];
				$cpCentreSelect = $_GET['cp'];
				$listeGroupesParCentre = $mdlEnseignant->ChargerGroupeParCentre($idCentreSelect);
			}
			
			if(isset($_GET['idCentre'], $_GET['nomCentre'])){
				$idCentre = $_GET['idCentre'];
				$nomCentre = $_GET['nomCentre'];
			} else { 
				$idCentre = $centresFormation[0]->getIdCentre(); 
				$nomCentre = $centresFormation[0]->getNomCentre();
			}
			
			$nbGroupesCentre = $mdlChefCentre->GetNbGroupes($idCentre);
			if(isset($_GET['pageCouranteGroupe'])){
				$pageMax = ceil($nbGroupesCentre/10);
				Validation::ValiderIdPage($_GET['pageCouranteGroupe'], $pageMax);
			} else { $_GET['pageCouranteGroupe'] = 1; }	
			if($nbGroupesCentre > 0){
				$listeGroupes = $mdlEnseignant->ChargerGroupeParCentre($idCentre);
				
				if(!empty($listeGroupes)){
					if(isset($_GET['idGroupe'],$_GET['nomGroupe'])){
						Validation::ValiderIdGroupe($_GET['idGroupe']);
						Validation::ValiderNomGroupe($_GET['nomGroupe']);
						$idGroupe = $_GET['idGroupe'];
						$nomGroupe = $_GET['nomGroupe'];
					} else { 
						$idGroupe = $listeGroupes[0]->getIdGroupe(); 
						$nomGroupe = $listeGroupes[0]->getNomGroupe(); 
					}
					$listeEleves = $mdlEnseignant->GetElevesParGroupe($idGroupe);				
				}
			}
		}
		require('./Vue/vuesGestion/vueGestionEleves.php');
	}
	
	public function AjouterClasseCC(){
		
		if(isset($_POST['idCentre'],$_POST['nomClasse'],$_POST['anneeEntree'],$_POST['anneeSortie'],$_POST['anneeEtude'],$_FILES['fichierClasse'],$_POST['tailleMaxFichier'],$_POST['idDiv'])){
			Validation::ValiderIdCentre($_POST['idCentre']);
			
			try{ 
				Validation::ValiderNomGroupe($_POST['nomClasse']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(!empty($_FILES['fichierClasse']['tmp_name'])){
				try{
					Validation::ValiderFichierAjoutClasse($_FILES['fichierClasse'],$_POST['tailleMaxFichier']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
				
				try{
					$tElevesFichier = file($_FILES['fichierClasse']['tmp_name']);
					$i = 1;
					foreach($tElevesFichier as $eleve){
						$nomsPrenoms = explode(' ',$eleve);
						Validation::ValiderPrenomEleve($nomsPrenoms[0], $i);
						Validation::ValiderNomEleve($nomsPrenoms[1], $i);
						$pseudo = strtolower(substr($nomsPrenoms[0],0,2).$nomsPrenoms[1]);
						$y = 2;
						while(Validation::ValiderDisponibiliteLoginPersonne($pseudo)){
							$pseudo = strtolower(substr($nomsPrenoms[0],0,2).$nomsPrenoms[1]).$y;
							$y++;
						}
						$password = $pseudo;
						$tEleves[$i] = array(trim($pseudo),trim($password),ucfirst($nomsPrenoms[0]),ucfirst($nomsPrenoms[1]));
						$i++;
					}
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			} else { $tEleves = null; }
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterClasse($_POST['idCentre'],ucfirst($_POST['nomClasse']),$_POST['anneeEtude'],$tEleves,$_SESSION['login'],$_POST['anneeSortie'],$_POST['anneeEtude']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesElevesCC";
			$ctrlChefCentre = new ControleurChefCentre($this->tableauErreurs);
		}
	}
	
	public function AjouterUnEtudiantCC(){
		
		if(isset($_POST['idGroupe'], $_POST['nomEtudiant'], $_POST['prenomEtudiant'])){
			Validation::ValiderIdGroupe($_POST['idGroupe']);
			
			try{
				Validation::ValiderNomEleve($_POST['nomEtudiant'], null);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderPrenomEleve($_POST['prenomEtudiant'], null);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			$pseudo = strtolower(substr($_POST['prenomEtudiant'],0,2).$_POST['nomEtudiant']);
			$y = 2;
			while(Validation::ValiderDisponibiliteLoginPersonne($pseudo)){
				$pseudo = strtolower(substr($nomsPrenoms[0],0,2).$nomsPrenoms[1]).$y;
				$y++;
			}
			$password = $pseudo;
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterUnEtudiant($_POST['idGroupe'],ucfirst($_POST['nomEtudiant']),ucfirst($_POST['prenomEtudiant']),$pseudo,$password);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesElevesCC";
			$ctrlChefCentre = new ControleurChefCentre($this->tableauErreurs);
		}
	}	

	public function SupprimerGroupeCC(){
		
		if(isset($_GET['idGroupe'])){
			Validation::ValiderIdGroupe($_GET['idGroupe']);	
			$mdlChefCentre = new ModeleChefCentre();
			$mdlChefCentre->SupprimerGroupeCC($_GET['idGroupe']);
			$_REQUEST['action'] = "ConsulterMesElevesCC";
			$ctrlChefCentre = new ControleurChefCentre($this->tableauErreurs);
		}
	}
	
	public function AjouterPlusieursEleves(){
	
		if(isset($_POST['idGroupe'],$_FILES['fichierClasse'],$_POST['idDiv'],$_POST['tailleMaxFichier'])){
			Validation::ValiderIdGroupe($_POST['idGroupe']);
			
			try{
				Validation::ValiderFichierAjoutClasse($_FILES['fichierClasse']['tmp_name'],$_POST['tailleMaxFichier']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
							
			if(empty($this->tableauErreurs)){
				try{
					$tElevesFichier = file($_FILES['fichierClasse']['tmp_name']);
					$i = 1;
					foreach($tElevesFichier as $eleve){
						$nomsPrenoms = explode(' ',$eleve);
						Validation::ValiderPrenomEleve($nomsPrenoms[0], $i);
						Validation::ValiderNomEleve($nomsPrenoms[1], $i);
						$pseudo = strtolower(substr($nomsPrenoms[0],0,2).$nomsPrenoms[1]);
						$y = 2;
						while(Validation::ValiderDisponibiliteLoginPersonne($pseudo)){
							$pseudo = strtolower(substr($nomsPrenoms[0],0,2).$nomsPrenoms[1]).$y;
							$y++;
						}
						$password = $pseudo;
						$tEleves[$i] = array(trim($pseudo),trim($password),ucfirst($nomsPrenoms[0]),ucfirst($nomsPrenoms[1]));
						$i++;
					}
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterPlusieursEleves($_POST['idGroupe'], $tEleves);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesElevesCC";
			$ctrlChefCentre = new ControleurChefCentre($this->tableauErreurs);
		}
	}

	public function SupprimerEleveCC(){
	
		if(isset($_GET['loginEleve'])){
			Validation::ValiderLoginEtudiant($_GET['loginEleve']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerEleve($_GET['loginEleve']);
			$_REQUEST['action'] = "ConsulterMesElevesCC";
			$ctrlChefCentre = new ControleurChefCentre(null);
		}
	}
}
?>