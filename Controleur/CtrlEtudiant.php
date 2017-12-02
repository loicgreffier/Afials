<?php
Autoloader::getInstance()->Autoload(array('MdlEtudiant', 'Validation', 'Nettoyage'));

class ControleurEtudiant{

	private $tableauErreurs = array();

	public function __construct($tableauErreursControleurs){
		
		if(!empty($tableauErreursControleurs)){
			$this->tableauErreurs['erreurAfficherPopup'] = $tableauErreursControleurs['erreurAfficherPopup'];
			unset($tableauErreursControleurs['erreurAfficherPopup']);
			foreach($tableauErreursControleurs as $erreur)
				$this->tableauErreurs[] = $erreur;
		}	
		
		switch($_REQUEST['action']){
			case "AjouterSujet":
								$this->AjouterSujet();
								break;
			case "AjouterMessage":
								$this->AjouterMessage();
								break;
			case "ConsulterAvis":
								$this->ConsulterAvis();
								break;
			case "AjouterAvis":
								$this->AjouterAvis();
								break;
			case "ConsulterMesNotes":
								$this->ConsulterMesNotes();
								break;
			case "GererMonCompte":
								$this->GererMonCompte();
								break;
			case "ModifierMdp":
								$this->ModifierMdp();
								break;
			case "ModifierInformations":
								$this->ModifierInformations();
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
	
	public function AjouterSujet(){
		
		if(isset($_POST['idForum'],$_POST['nomForum'],$_POST['titreSujet'],$_POST['messageSujet'])){
			
			Validation::ValiderIdForum($_POST['idForum']);
			Validation::ValiderNomForum($_POST['nomForum']);
			
			try{
				Validation::ValiderTitreSujet($_POST['titreSujet']);		
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }

			try{
				Validation::ValiderMessage($_POST['messageSujet']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEtudiant->AjouterSujet(ucfirst($_POST['idForum']), ucfirst($_POST['titreSujet']), ucfirst($_POST['messageSujet']), $_SESSION['login']);
			} 
			$_REQUEST['action'] = "ConsulterForum";
			$_GET['idForum'] = $_POST['idForum'];
			$_GET['nomForum'] = $_POST['nomForum'];
			$ctrlVisiteur = new ControleurVisiteur($this->tableauErreurs);
		}
	}
	
	public function AjouterMessage(){
	
		if(isset($_POST['idSujet'],$_POST['message'],$_POST['nomSujet'], $_POST['nomForum'], $_POST['idForum'], $_POST['pageCouranteForum'])){
			Validation::ValiderIdSujet($_POST['idSujet']);
			Validation::ValiderNomSujet($_POST['nomSujet']);
			Validation::ValiderIdForum($_POST['idForum']);
			Validation::ValiderNomForum($_POST['nomForum']);
			echo $_POST['idSujet'],$_POST['message'],$_POST['nomSujet'];
			try{
				Validation::ValiderMessage($_POST['message']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEtudiant->AjouterMessage($_POST['message'], $_POST['idSujet'], $_SESSION['login']);
			} 
			$_REQUEST['action'] = "ConsulterSujet";
			$_GET['idSujet'] = $_POST['idSujet'];
			$_GET['nomSujet'] = $_POST['nomSujet'];
			$_GET['idForum'] = $_POST['idForum'];
			$_GET['nomForum'] = $_POST['nomForum'];
			$_GET['pageCouranteForum'] = $_POST['pageCouranteForum'];
			$ctrlVisiteur = new ControleurVisiteur($this->tableauErreurs);
		}
	}
	
	public function ConsulterAvis(){
	
		if(isset($_GET['idFormation'],$_GET['nomEnseignant'],$_GET['prenomEnseignant'])){
			Validation::ValiderIdFormation($_GET['idFormation']);
			Validation::ValiderNomPrenomEnseignant($_GET['nomEnseignant'],$_GET['prenomEnseignant']);
			$nomEnseignant = $_GET['nomEnseignant'];
			$prenomEnseignant = $_GET['prenomEnseignant'];
				
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
				
			$mdlEtudiant = new ModeleEtudiant();
			$formation = $mdlEtudiant->GetFormationById($_GET['idFormation']);
			$avis = $mdlEtudiant->GetAvisFormationById($_GET['idFormation']);
			
			if(isset($_COOKIE['couleurSite'])){
				switch($_COOKIE['couleurSite']){
					case "Bleu": $couleur = '#5E5EFF'; break;
					case "Rouge": $couleur = '#FF6767'; break;
					case "Vert": $couleur = '#71FF71'; break;
				}
			} else { $couleur = '#5E5EFF'; }
			require('./Vue/vueAvisFormation.php');
		}
	}
	
	public function AjouterAvis(){
	
		if(isset($_POST['idDiv'], $_POST['noteAvis'], $_POST['commentaireAvis'], $_POST['idFormation'], $_SESSION['login'], $_POST['nomEnseignant'], $_POST['prenomEnseignant'])){
			Validation::ValiderLoginPersonne($_SESSION['login']);
			Validation::ValiderIdFormation($_POST['idFormation']);
			Validation::ValiderNomPrenomEnseignant($_POST['nomEnseignant'],$_POST['prenomEnseignant']);
			
			try{
				Validation::ValiderDejaCommenter($_SESSION['login'],$_POST['idFormation']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNoteAvis($_POST['noteAvis']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderCommentaireAvis($_POST['commentaireAvis']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEtudiant->AjouterAvis($_POST['noteAvis'], $_POST['commentaireAvis'], $_POST['idFormation'], $_SESSION['login']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterAvis";
			$_GET['nomEnseignant'] = $_POST['nomEnseignant'];
			$_GET['prenomEnseignant'] = $_POST['prenomEnseignant'];
			$_GET['idFormation'] = $_POST['idFormation'];
			new ControleurEtudiant($this->tableauErreurs);
		}
	}
	
	public function ConsulterMesNotes(){
	
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
		
		$mdlEtudiant = new ModeleEtudiant();
		$nbFormationsEvaluees = $mdlEtudiant->CountNbFormationsEvalueesEleve($loginPersonneConnectee);
				
		if(isset($_GET['pageCouranteFormation'])){
			$pageMax = ceil($nbFormationsEvaluees/20);
			Validation::ValiderIdPage($_GET['pageCouranteFormation'], $pageMax);
		} else { $_GET['pageCouranteFormation'] = 1; }
		if($nbFormationsEvaluees > 0){
			$listeFormationsEvalueesEleve = $mdlEtudiant->GetMesFormationsEvaluees($loginPersonneConnectee,$_GET['pageCouranteFormation']);
					
			if(isset($_GET['idFormation'],$_GET['nomFormation'])){
				Validation::ValiderIdFormation($_GET['idFormation']);
				Validation::ValiderNomFormationExistant($_GET['nomFormation']);
				$idFormation = $_GET['idFormation'];
				$nomFormation = $_GET['nomFormation'];
			} else { 
				$idFormation = $listeFormationsEvalueesEleve[0]->getIdFormation();
				$nomFormation = $listeFormationsEvalueesEleve[0]->getNomFormation();
			}
					
			$nbDevoirsEleve = $mdlEtudiant->CountDevoirsParFormationEleve($idFormation,$loginPersonneConnectee);
			if($nbDevoirsEleve > 0){
				$devoirsEleves = $mdlEtudiant->GetDevoirsParFormationEleve($idFormation, $loginPersonneConnectee);
				foreach($devoirsEleves as $devoir)
					$tNotes[$devoir->getIdDevoir()] = $mdlEtudiant->GetNoteDuDevoir($devoir->getIdDevoir(), $loginPersonneConnectee);
					
				$tableauDevoirsNotes['devoir'] = $devoirsEleves;
				$tableauDevoirsNotes['note'] = $tNotes;
				
				$sommeNoteMax = 0;
				$sommeNote = 0;
				foreach($tableauDevoirsNotes['devoir'] as $devoir){
					$date = explode("-",$devoir->getDate());
					$devoir->setDate($date[2]."/".$date[1]."/".$date[0]);
					$sommeNoteMax = $sommeNoteMax + ($devoir->getNoteMax()*$devoir->getCoefficient());
					$sommeNote = $sommeNote + ($tableauDevoirsNotes['note'][$devoir->getIdDevoir()]->getNote() * $devoir->getCoefficient());
				}
				$moyenne = $sommeNote/($sommeNoteMax/20);
			}
		}
		require('./Vue/vuesGestion/vueNotesEleves.php');
	}
	
	public function GererMonCompte(){
	
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
		
		$mdlEtudiant = new ModeleEtudiant();
		$informationsPersonne = $mdlEtudiant->GetInformationsPersonne($_SESSION['login']);
		$telephoneSyntaxe = str_replace("-", "", $informationsPersonne->getTel());
		require('./Vue/vueGestionMonCompte.php');
	}
	
	public function ModifierMdp(){
	
		if(isset($_POST['loginPersonneConnectee'], $_POST['mdpActuel'], $_POST['nouveauMdp'], $_POST['nouveauMdpConfirmation'], $_POST['idDiv'])){
			Validation::ValiderLoginPersonne($_POST['loginPersonneConnectee']);
			
			try{
				Validation::ValiderMdpPersonne($_POST['mdpActuel'], $_POST['loginPersonneConnectee']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNouveauMdpPersonne($_POST['nouveauMdp'], $_POST['nouveauMdpConfirmation']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEtudiant->ModifierMdp($_POST['loginPersonneConnectee'], $_POST['nouveauMdp']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "GererMonCompte";
			new ControleurEtudiant($this->tableauErreurs);
		}
	}
	
	public function ModifierInformations(){
	
		if(isset($_POST['loginPersonneConnectee'], $_POST['nomModifier'], $_POST['prenomModifier'], $_POST['idDiv'], $_POST['emailModifier'], $_POST['telModifier'])){
			Validation::ValiderLoginPersonne($_POST['loginPersonneConnectee']);
					
			try{
				Validation::ValiderNom($_POST['nomModifier']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderPrenom($_POST['prenomModifier']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(!empty($_POST['emailModifier'])){
				try{
					Validation::ValiderEmail($_POST['emailModifier']);
				} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			if(!empty($_POST['telModifier'])){
				try{
					Validation::ValiderTelephone($_POST['telModifier']);
					$_POST['telModifier'] = Nettoyage::CreerNumeroTelephone($_POST['telModifier']);
				} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			if(empty($this->tableauErreurs)){
				$mdlEtudiant = new ModeleEtudiant();
				$mdlEtudiant->ModifierInformations($_POST['loginPersonneConnectee'], $_POST['nomModifier'], $_POST['prenomModifier'], $_POST['emailModifier'], $_POST['telModifier']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "GererMonCompte";
			new ControleurEtudiant($this->tableauErreurs);
		}
	}
}
?>
				