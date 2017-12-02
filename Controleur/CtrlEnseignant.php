<?php
Autoloader::getInstance()->Autoload(array('MdlEnseignant','Validation', 'Nettoyage'));

class ControleurEnseignant{

	private $tableauErreurs = array();

	public function __construct($tableauErreursControleurs){
	
		if(!empty($tableauErreursControleurs)){
			$this->tableauErreurs['erreurAfficherPopup'] = $tableauErreursControleurs['erreurAfficherPopup'];
			unset($tableauErreursControleurs['erreurAfficherPopup']);
			foreach($tableauErreursControleurs as $erreur)
				$this->tableauErreurs[] = $erreur;
		}	
			
		switch($_REQUEST['action']){
			case "SupprimerForum":
								$this->SupprimerForum();
								break;
			case "SupprimerSujet":
								$this->SupprimerSujet();
								break;
			case "SupprimerMessage":
								$this->SupprimerMessage();
								break;
			case "AjouterForum":
								$this->AjouterForum();
								break;
			case "ConsulterMesFormations":
								$this->ConsulterMesFormations();
								break;
			case "ModifierFormation":
								$this->ModifierFormation();
								break;
			case "AjouterFormation":
								$this->AjouterFormation();
								break;
			case "AjouterTypeFormation":
								$this->AjouterTypeFormation();
								break;
			case "SupprimerFormation":
								$this->SupprimerFormation();
								break;
			case "ConsulterAgenda":
								$this->ConsulterAgenda();
								break;
			case "AjouterIntervention":
								$this->AjouterIntervention();
								break;
			case "SupprimerIntervention":
								$this->SupprimerIntervention();
								break;
			case "ViderAgenda":
								$this->ViderAgenda();
								break;
			case "ConsulterMesCentresFormation":
								$this->ConsulterMesCentresFormation();
								break;
			case "AjouterCentreFormation":
								$this->AjouterCentreFormation();
								break;
			case "AjouterCentreFormationExistant":
								$this->AjouterCentreFormationExistant();
								break;
			case "SupprimerCentreFormation":
								$this->SupprimerCentreFormation();
								break;
			case "ModifierCentreFormation":
								$this->ModifierCentreFormation();
								break;
			case "ConsulterMesEleves":
								$this->ConsulterMesEleves();
								break;
			case "AjouterClasse": 
								$this->AjouterClasse();
								break;
			case "AjouterUnEtudiant":
								$this->AjouterUnEtudiant();
								break;
			case "SupprimerGroupe":
								$this->SupprimerGroupe();
								break;
			case "AjouterGroupeExistant";
								$this->AjouterGroupeExistant();
								break;
			case "AjouterPlusieursEleves":
								$this->AjouterPlusieursEleves();
								break;
			case "AjouterNotes":
								$this->AjouterNotes();
								break;
			case "ConsulterNotes":
								$this->ConsulterNotes();
								break;
			case "SupprimerEleve":
								$this->SupprimerEleve();
								break;
			case "SupprimerDevoir":
								$this->SupprimerDevoir();
								break;
			case "ModifierNotes":
								$this->ModifierNotes();
								break;
			case "ConsulterDemandesInscription":
								$this->ConsulterDemandesInscription();
								break;
			case "DeclinerDemandeInscription":
								$this->DeclinerDemandeInscription();
								break;
			case "ValiderDemandeInscription":
								$this->ValiderDemandeInscription();
								break;
			case "SupprimerAvis":
								$this->SupprimerAvis();
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
		
	/*** FORUM ***/
	public function SupprimerForum(){ 
	
		if(isset($_GET['idForum'])){
			Validation::ValiderIdForum($_GET['idForum']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerForum($_GET['idForum']);
			$_REQUEST['action'] = "ConsulterPageForum";
			new ControleurVisiteur(null);
		}
	}
	
	public function AjouterForum(){
	
		if(isset($_POST['titreForum'],$_POST['idDiv'])){
			try{
				Validation::ValiderTitreForum($_POST['titreForum']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterForum($_POST['titreForum']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; } 
			$_REQUEST['action'] = "ConsulterPageForum";
			new ControleurVisiteur($this->tableauErreurs);
		}
	}
			
	
	public function SupprimerSujet(){
			
		if(isset($_GET['idSujet'],$_GET['nomForum'],$_GET['idForum'])){
			Validation::ValiderIdSujet($_GET['idSujet']);
			Validation::ValiderNomForum($_GET['nomForum']);
			Validation::ValiderIdForum($_GET['idForum']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerSujet($_GET['idSujet']);
			$_REQUEST['action'] = "ConsulterForum";
			$nomForum = $_GET['nomForum'];
			$idForum = $_GET['idForum'];
			$ctrlVisiteur = new ControleurVisiteur(null);
		}
	}
	
	public function SupprimerMessage(){
	
		if(isset($_GET['idMessage'],$_GET['nomSujet'],$_GET['idSujet'], $_GET['nomForum'], $_GET['idForum'], $_GET['pageCouranteForum'])){
			Validation::ValiderIdMessage($_GET['idMessage']);
			Validation::ValiderNomSujet($_GET['nomSujet']);
			Validation::ValiderIdSujet($_GET['idSujet']);
			Validation::ValiderIdForum($_GET['idForum']);
			Validation::ValiderNomForum($_GET['nomForum']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerMessage($_GET['idMessage']);
			$_REQUEST['action'] = "ConsulterSujet";
			$ctrlVisiteur = new ControleurVisiteur(null);
		}
	}
	
	/*** FORMATIONS ***/
	public function ConsulterMesFormations(){
	
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
		
		if(isset($_POST['modifierIdFormation'], $_POST['modifierNomFormation'], $_POST['modifierDescriptifFormation'])){
			$idFormationModifie = $_POST['modifierIdFormation'];
			$nomFormationModifie = $_POST['modifierNomFormation'];
			$descriptifFormationModifie = $_POST['modifierDescriptifFormation'];
		}
		
		$mdlEnseignant = new ModeleEnseignant();
		$nbFormationEnseignant = $mdlEnseignant->GetNbFormationEnseignant($loginPersonneConnectee);
		if(isset($_GET['pageCouranteFormation'])){
			$pageMax = ceil($nbFormationEnseignant/5);
			Validation::ValiderIdPage($_GET['pageCouranteFormation'], $pageMax);
		} else { $_GET['pageCouranteFormation'] = 1; }
		
		if($nbFormationEnseignant > 0)
			$formationsEnseignant = $mdlEnseignant->GetFormationsEnseignant($loginPersonneConnectee,$_GET['pageCouranteFormation']);
		$listeTypesFormation = $mdlEnseignant->GetListeTypesFormation();
		require('./Vue/vuesGestion/vueGestionFormations.php');
	}
		
	public function AjouterFormation(){
		
		if(isset($_POST['nomFormation'],$_POST['descriptif'],$_POST['loginEnseignant'],$_POST['nomTypeFormation'],$_POST['idDiv'])){
			Validation::ValiderLoginEnseignant($_POST['loginEnseignant']);
	
			try{
				Validation::ValiderNomTypeFormation($_POST['nomTypeFormation']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNomFormation($_POST['nomFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderDescriptifFormation($_POST['descriptif']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
				
			if(empty($this->tableauErreurs)){	
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterFormation(ucfirst($_POST['nomFormation']),ucfirst($_POST['descriptif']),$_POST['loginEnseignant'],$_POST['nomTypeFormation']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = 'ConsulterMesFormations';
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);	
		}
	}
	
	public function ModifierFormation(){
		
		if(isset($_POST['idDiv'], $_POST['modifierIdFormation'], $_POST['modifierNomFormation'], $_POST['modifierDescriptifFormation'], $_POST['nomTypeFormation'])){
			Validation::ValiderIdFormation($_POST['modifierIdFormation']);

			try{
				Validation::ValiderNomTypeFormation($_POST['nomTypeFormation']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNomFormation($_POST['modifierNomFormation']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderDescriptifFormation($_POST['modifierDescriptifFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){	
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->ModifierFormation($_POST['modifierIdFormation'], $_POST['modifierNomFormation'], $_POST['modifierDescriptifFormation'], $_POST['nomTypeFormation']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = 'ConsulterMesFormations';
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);	
		}
	}
	
	public function AjouterTypeFormation(){
	
		if(isset($_POST['nomTypeFormation'],$_POST['idDiv'])){
			try{
				Validation::ValiderNouveauTypeFormation($_POST['nomTypeFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterTypeFormation(ucfirst($_POST['nomTypeFormation']));
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesFormations";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function SupprimerFormation(){
	
		if(isset($_GET['idFormation'])){
			if(isset($_SESSION['login']))
				$loginPersonneConnectee = $_SESSION['login'];			
			Validation::ValiderIdFormation($_GET['idFormation']);
			Validation::ValiderLoginEnseignant($loginPersonneConnectee);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerFormation($_GET['idFormation'],$loginPersonneConnectee);
			$_REQUEST['action'] = "ConsulterMesFormations";
			$ctrlEnseignant = new ControleurEnseignant(null);
		}
	}
	
	/*** AGENDA ***/
	public function ConsulterAgenda(){
		
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
		$nbInterventionsEnseignant = $mdlEnseignant->GetNbInterventionsEnseignant($loginPersonneConnectee);
		if(isset($_GET['pageCouranteIntervention'])){
			$pageMax = ceil($nbInterventionsEnseignant/5);
			Validation::ValiderIdPage($_GET['pageCouranteIntervention'], $pageMax);
		} else { $_GET['pageCouranteIntervention'] = 1; }
		
		if($nbInterventionsEnseignant > 0){
			$interventions = $mdlEnseignant->GetInterventionsEnseignant($loginPersonneConnectee,$_GET['pageCouranteIntervention']);
		}
		$formations = $mdlEnseignant->GetFormationsEnseignant($loginPersonneConnectee, null);
		$centresFormation = $mdlEnseignant->GetCentresFormationEnseignant($loginPersonneConnectee, null);
		require('./Vue/vuesGestion/VueGestionAgenda.php');
	}
	
	public function AjouterIntervention(){
		
		if(isset($_POST['jourDebut'],$_POST['moisDebut'],$_POST['anneeDebut'],$_POST['heureDebut'],$_POST['minuteDebut'],
				 $_POST['jourFin'],$_POST['moisFin'],$_POST['anneeFin'],$_POST['heureFin'],$_POST['minuteFin'],
				 $_POST['salle'],$_POST['nbRepetitions'],$_POST['loginEnseignant'],$_POST['idCentre'],$_POST['idFormation'],$_POST['idDiv'])){
			
			Validation::ValiderLoginEnseignant($_POST['loginEnseignant']);
			
			try{
				Validation::ValiderIdCentreExistant($_POST['idCentre']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderIdFormationExistante($_POST['idFormation']);
			} catch(Exception $e){ $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				$dateDebut = $_POST['anneeDebut']."-".$_POST['moisDebut']."-".$_POST['jourDebut']." ".$_POST['heureDebut'].":".$_POST['minuteDebut'];
				$dateFin = $_POST['anneeFin']."-".$_POST['moisFin']."-".$_POST['jourFin']." ".$_POST['heureFin'].":".$_POST['minuteFin'];
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(!empty($_POST['salle'])){
				try{
					Validation::ValiderSalle($_POST['salle']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterIntervention($dateDebut,$dateFin,$_POST['nbRepetitions'],$_POST['salle'],$_POST['loginEnseignant'],$_POST['idCentre'],$_POST['idFormation']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterAgenda";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function SupprimerIntervention(){
	
		if(isset($_GET['idIntervention'])){
			Validation::ValiderIdIntervention($_GET['idIntervention']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerIntervention($_GET['idIntervention']);
			$_REQUEST['action'] = "ConsulterAgenda";
			$ctrlVisiteur = new ControleurEnseignant(null);
		}
	}
	
	public function ViderAgenda(){
	
		$mdlEnseignant = new ModeleEnseignant();
		$mdlEnseignant->ViderAgenda();
		$_REQUEST['action'] = "ConsulterAgenda";
		$ctrlVisiteur = new ControleurEnseignant(null);
	}	
	
	/*** CENTRE FORMATION ***/
	public function ConsulterMesCentresFormation(){
			
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
		
		if(isset($_POST['idCentre'], $_POST['nomCentreFormation'], $_POST['villeCentreFormation'], $_POST['rueCentreFormation'], $_POST['cpCentreFormation'], $_POST['loginNouveauChefCentre'])){
			$idCentreModifie = $_POST['idCentre'];
			$nomCentreModifie = $_POST['nomCentreFormation'];
			$villeCentreModifie = $_POST['villeCentreFormation'];
			$rueCentreModifie = $_POST['rueCentreFormation'];
			$cpCentreModifie = $_POST['cpCentreFormation'];
		}
		
		$mdlEnseignant = new ModeleEnseignant();
		$nbCentresFormation = $mdlEnseignant->GetNbCentresFormationEnseignant($loginPersonneConnectee);
		if(isset($_GET['pageCouranteCentresFormation'])){
			$pageMax = ceil($nbCentresFormation/10);
			Validation::ValiderIdPage($_GET['pageCouranteCentresFormation'], $pageMax);
		} else { $_GET['pageCouranteCentresFormation'] = 1; }
		
		if($nbCentresFormation > 0){
			$centresFormation = $mdlEnseignant->GetCentresFormationEnseignant($loginPersonneConnectee, $_GET['pageCouranteCentresFormation']);
			foreach($centresFormation as $centre)
				$chefCentre[$centre->getIdCentre()] = $mdlEnseignant->GetInformationsChefCentre($centre->getIdcentre());
		}
		$listeChefsCentre = $mdlEnseignant->GetChefsCentre();
		$listeTousLesCentres = $mdlEnseignant->GetListeCentres();
		require('./Vue/vuesGestion/vueGestionCentresFormation.php');	
	}
	
	public function AjouterCentreFormation(){
	
		if(isset($_POST['loginEnseignantAjoutant'],$_POST['nomCentreFormation'],$_POST['villeCentreFormation'],$_POST['rueCentreFormation'],$_POST['cpCentreFormation'],
				 $_POST['loginChefCentre'],$_POST['nomCC'],$_POST['prenomCC'],$_POST['emailCC'],$_POST['telCC'],$_POST['idDiv'])){

			Validation::ValiderLoginEnseignant($_POST['loginEnseignantAjoutant']);
			try{
				Validation::ValiderNomCentreFormation($_POST['nomCentreFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderVilleCentre($_POST['villeCentreFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderRueCentre($_POST['rueCentreFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderCodePostalCentre($_POST['cpCentreFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
	
			if(empty($_POST['loginChefCentre']) && (empty($_POST['nomCC']) || empty($_POST['prenomCC']))){
				$this->tableauErreurs[] = "Erreur vous devez selectionner un chef de centre ou en ajouter un nouveau";
			}
			
			if(!empty($_POST['loginChefCentre']))
				Validation::ValiderLoginPersonne($_POST['loginChefCentre']);
			
			$pseudo = null;
			$password = null;
			if(!empty($_POST['nomCC']) && !empty($_POST['prenomCC'])){
				try{
					Validation::ValiderNomChefCentre($_POST['nomCC']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
						
				try{
					Validation::ValiderPrenomChefCentre($_POST['prenomCC']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
				
				$pseudo = strtolower(substr($_POST['prenomCC'],0,2).$_POST['nomCC']);
				$y = 2;
				while(Validation::ValiderDisponibiliteLoginPersonne($pseudo)){
					$pseudo = strtolower(substr($_POST['prenomCC'],0,2).$_POST['nomCC']).$y;
					$y++;
				}
				$password = $pseudo;
			}

			if(!empty($_POST['emailCC'])){
				try{
					Validation::ValiderEmailChefCentre($_POST['emailCC']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			if(!empty($_POST['telCC'])){
				try{
					Validation::ValiderTelephoneChefCentre($_POST['telCC']);
					$_POST['telCC'] = Nettoyage::CreerNumeroTelephone($_POST['telCC']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			}
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterCentreFormation($_POST['loginEnseignantAjoutant'],ucfirst($_POST['nomCentreFormation']),ucfirst($_POST['villeCentreFormation']),
													   ucfirst($_POST['rueCentreFormation']),$_POST['cpCentreFormation'],$_POST['loginChefCentre'],
													   ucfirst($_POST['nomCC']),ucfirst($_POST['prenomCC']),$_POST['emailCC'],$_POST['telCC'],$pseudo,$password);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesCentresFormation";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function AjouterCentreFormationExistant(){

		if(isset($_POST['idCentre'],$_POST['loginPersonne'], $_POST['idDiv'])){
		
			try{
				Validation::ValiderIdCentreExistant($_POST['idCentre']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			Validation::ValiderLoginEnseignant($_POST['loginPersonne']);
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterCentreFormationExistant($_POST['idCentre'], $_POST['loginPersonne']);
			} else {  $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesCentresFormation";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function ModifierCentreFormation(){
		
		if(isset($_POST['idCentre'], $_POST['idDiv'], $_POST['nomCentreFormation'], $_POST['villeCentreFormation'], $_POST['rueCentreFormation'], $_POST['cpCentreFormation'],$_POST['loginNouveauChefCentre'])){
				 Validation::ValiderIdCentre($_POST['idCentre']);
				 
				 if(!empty($_POST['loginNouveauChefCentre'])){
					Validation::ValiderLoginPersonne($_POST['loginNouveauChefCentre']);
				} else { $this->tableauErreurs[] = "Vous devez renseigné un chef"; }
				
				try{
					Validation::ValiderNomCentreFormation($_POST['nomCentreFormation']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
				try{
					Validation::ValiderVilleCentre($_POST['villeCentreFormation']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
				try{
					Validation::ValiderRueCentre($_POST['rueCentreFormation']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
				try{
					Validation::ValiderCodePostalCentre($_POST['cpCentreFormation']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
				
				if(empty($this->tableauErreurs)){
					$mdlEnseignant = new ModeleEnseignant();
					$mdlEnseignant->ModifierCentreFormation($_POST['idCentre'], $_POST['nomCentreFormation'], $_POST['villeCentreFormation'], $_POST['rueCentreFormation'], $_POST['cpCentreFormation'], $_POST['loginNouveauChefCentre']);									
				} else { 
					$this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
				$_REQUEST['action'] = "ConsulterMesCentresFormation";
				new ControleurEnseignant($this->tableauErreurs);
			}
	}
	
	public function SupprimerCentreFormation(){
	
		if(isset($_GET['idCentre'])){
			if(isset($_SESSION['login']))
				$loginEnseignant = $_SESSION['login'];
			Validation::ValiderIdCentre($_GET['idCentre']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerCentreFormation($_GET['idCentre'],$loginEnseignant);
			$_REQUEST['action'] = "ConsulterMesCentresFormation";
			$ctrlEnseignant = new ControleurEnseignant(null);
		}
	}
	
	public function ConsulterMesEleves(){
		
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
		$nbCentresFormation = $mdlEnseignant->GetNbCentresFormationEnseignant($loginPersonneConnectee);
		
		if(isset($_GET['pageCouranteCentresFormation'])){
			$pageMax = ceil($nbCentresFormation/20);
			Validation::ValiderIdPage($_GET['pageCouranteCentresFormation'], $pageMax);
		} else { $_GET['pageCouranteCentresFormation'] = 1; }
		
		if($nbCentresFormation > 0){
			$centresFormation = $mdlEnseignant->GetCentresFormationEnseignant($loginPersonneConnectee,$_GET['pageCouranteCentresFormation']);
			if(isset($_GET['idCentreSelect'],$_GET['nomCentreSelect'],$_GET['cp'])){
				Validation::ValiderIdCentre($_GET['idCentreSelect']);
				Validation::ValiderNomCentre($_GET['nomCentreSelect']);
				Validation::ValiderCodePostalCentre($_GET['cp']);
				$idCentreSelect = $_GET['idCentreSelect'];
				$nomCentreSelect = $_GET['nomCentreSelect'];
				$cpCentreSelect = $_GET['cp'];
				$listeGroupesParCentre = $mdlEnseignant->ChargerGroupeParCentre($idCentreSelect);
			} else {
				$listeGroupesParCentre = $mdlEnseignant->ChargerGroupeParCentre($centresFormation[0]->getIdCentre());
			}
			
			$nbGroupesEnseignant = $mdlEnseignant->GetNbGroupesEnseignant($loginPersonneConnectee);
			if(isset($_GET['pageCouranteGroupe'])){
				$pageMax = ceil($nbGroupesEnseignant/10);
				Validation::ValiderIdPage($_GET['pageCouranteGroupe'], $pageMax);
			} else { $_GET['pageCouranteGroupe'] = 1; }	
			if($nbGroupesEnseignant > 0){
				if(isset($_GET['idCentre'], $_GET['nomCentre'])){
					$idCentre = $_GET['idCentre'];
					$nomCentre = $_GET['nomCentre'];
				} else { 
					$idCentre = $centresFormation[0]->getIdCentre(); 
					$nomCentre = $centresFormation[0]->getNomCentre();
				}
				$listeGroupes = $mdlEnseignant->GetGroupesEnseignantParCentre($loginPersonneConnectee,$idCentre,$_GET['pageCouranteGroupe']);
				
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
	
	public function AjouterClasse(){
		
		if(isset($_POST['idCentre'],$_POST['nomClasse'],$_POST['anneeEntree'],$_POST['anneeSortie'],$_POST['anneeEtude'],$_FILES['fichierClasse'],$_POST['tailleMaxFichier'],$_POST['idDiv'])){
			
			try{
				Validation::ValiderIdCentreExistant($_POST['idCentre']);
			} catch(Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{ 
				Validation::ValiderNomGroupe($_POST['nomClasse']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(!empty($_FILES['fichierClasse']['tmp_name'])){
				try{
					Validation::ValiderFichierAjoutClasse($_FILES['fichierClasse'],$_POST['tailleMaxFichier']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
				
				if(empty($this->tableauErreurs)){
					try{
						$tElevesFichier = file($_FILES['fichierClasse']['tmp_name']);
						$i = 1;
						foreach($tElevesFichier as $eleve){
							$nomsPrenoms = explode(' ',$eleve);
							if(!isset($nomsPrenoms[0], $nomsPrenoms[1]))
								$this->tableauErreurs[] = "Erreur, le fichier doit contenir le prénom/nom des élèves";
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
				}
			} else { $tEleves = null; }
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterClasse($_POST['idCentre'],ucfirst($_POST['nomClasse']),$_POST['anneeEtude'],$tEleves,$_SESSION['login'],$_POST['anneeSortie'],$_POST['anneeEtude']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesEleves";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function AjouterPlusieursEleves(){
		
		if(isset($_POST['idGroupe'],$_FILES['fichierClasse'],$_POST['idDiv'],$_POST['tailleMaxFichier'])){
			Validation::ValiderIdGroupe($_POST['idGroupe']);
			
			if(!empty($_FILES['fichierClasse']['tmp_name'])){
				try{
					Validation::ValiderFichierAjoutClasse($_FILES['fichierClasse'],$_POST['tailleMaxFichier']);
				} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
				if(empty($this->tableauErreurs)){
					try{
						$tElevesFichier = file($_FILES['fichierClasse']['tmp_name']);
						$i = 1;
						foreach($tElevesFichier as $eleve){
							$nomsPrenoms = explode(' ',$eleve);
							if(!isset($nomsPrenoms[0], $nomsPrenoms[1]))
									$this->tableauErreurs[] = "Erreur, le fichier doit contenir le prénom/nom des élèves";
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
				}
			} else { $this->tableauErreurs[] = "Aucun fichier renseigné"; }
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterPlusieursEleves($_POST['idGroupe'], $tEleves);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesEleves";
			new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function AjouterUnEtudiant(){
		
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
				$pseudo = strtolower(substr($_POST['prenomEtudiant'],0,2).$_POST['nomEtudiant']).$y;
				$y++;
			}
			$password = $pseudo;
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterUnEtudiant($_POST['idGroupe'],ucfirst($_POST['nomEtudiant']),ucfirst($_POST['prenomEtudiant']),$pseudo,$password);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesEleves";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}	

	public function SupprimerGroupe(){
		
		if(isset($_GET['idGroupe'])){
			Validation::ValiderIdGroupe($_GET['idGroupe']);	
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerGroupe($_GET['idGroupe'],$_SESSION['login']);
			$_REQUEST['action'] = "ConsulterMesEleves";
			$ctrlVisiteur = new ControleurEnseignant(null);
		}
	}

	public function AjouterGroupeExistant(){
		
		if(isset($_POST['idGroupe'], $_POST['idDiv'], $_POST['idCentre'])){
		
			try{
			    Validation::ValiderIdGroupeExistant($_POST['idGroupe']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			if(empty($_POST['idCentre'])){
				$this->tableauErreurs[] = "Erreur, veuillez selectionner un centre";
			}
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$mdlEnseignant->AjouterGroupeExistant($_POST['idGroupe'],$_SESSION['login']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterMesEleves";
			$ctrlVisiteur = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function ConsulterNotes(){
		
		if(isset($_GET['idGroupe'],$_GET['nomGroupe'],$_GET['nomCentre'],$_GET['idCentre'])){	
			Validation::ValiderIdGroupe($_GET['idGroupe']);
			Validation::ValiderNomGroupe($_GET['nomGroupe']);
			Validation::ValiderNomCentre($_GET['nomCentre']);
			Validation::ValiderIdCentre($_GET['idCentre']);
			
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
			
			if(isset($_POST['idDevoir'], $_POST['nomDevoirModifie'], $_POST['noteMaxModifie'],$_POST['coefficientModifie'], $_POST['dateDevoirModifie'])){
				$idDevoir = $_POST['idDevoir'];
				$nomDevoir = $_POST['nomDevoirModifie'];
				$noteMax = $_POST['noteMaxModifie'];
				$coefficient = $_POST['coefficientModifie'];
				$_GET['date'] = $_POST['dateDevoirModifie'];
			}
			
			$mdlEnseignant = new ModeleEnseignant();
			$mesFormations = $mdlEnseignant->GetFormationsEnseignant($loginPersonneConnectee,null);
			$idGroupeActuel = $_GET['idGroupe'];
			$nomGroupeActuel = $_GET['nomGroupe'];
			$nomCentreDuGroupeActuel = $_GET['nomCentre'];
			$idCentreDuGroupeActuel = $_GET['idCentre'];
			$listeEleves = $mdlEnseignant->GetElevesParGroupe($_GET['idGroupe']);
			
			if(!empty($listeEleves)){
				$nbListeFormationsEvaluees = $mdlEnseignant->CountNbFormationsEvalueesDuGroupe($listeEleves[0]->getLogin());
				
				if(isset($_GET['pageCouranteFormation'])){
					$pageMax = ceil($nbListeFormationsEvaluees/20);
					Validation::ValiderIdPage($_GET['pageCouranteFormation'], $pageMax);
				} else { $_GET['pageCouranteFormation'] = 1; }
				
				if($nbListeFormationsEvaluees > 0){
					$listeFormationsEvalueesDuGroupe = $mdlEnseignant->GetListeFormationsEvalueesDuGroupe($listeEleves[0]->getLogin(),$_GET['pageCouranteFormation']);
					
					if(isset($_GET['idFormation'],$_GET['nomFormation'])){
						Validation::ValiderIdFormation($_GET['idFormation']);
						Validation::ValiderNomFormationExistant($_GET['nomFormation']);
						$idFormation = $_GET['idFormation'];
						$nomFormation = $_GET['nomFormation'];
					} else { 
						$idFormation = $listeFormationsEvalueesDuGroupe[0]->getIdFormation();
						$nomFormation = $listeFormationsEvalueesDuGroupe[0]->getNomFormation();
					}
					
					$nbDevoirsGroupe = $mdlEnseignant->CountDevoirsParFormationParGroupe($idFormation,$listeEleves[0]->getLogin());
					if(isset($_GET['pageCouranteDevoir'])){
						$pageMax = ceil($nbDevoirsGroupe/20);
						Validation::ValiderIdPage($_GET['pageCouranteDevoir'], $pageMax);
					} else { $_GET['pageCouranteDevoir'] = 1; }
					
					if($nbDevoirsGroupe > 0){
						$listeDevoirsDuGroupe = $mdlEnseignant->GetDevoirsParFormationParGroupe($idFormation, $_GET['pageCouranteDevoir'], $listeEleves[0]->getLogin());
						
						if(isset($_GET['idDevoir'],$_GET['nomDevoir'],$_GET['noteMax'],$_GET['coefficient'],$_GET['date'])){
							Validation::ValiderIdDevoir($_GET['idDevoir']);
							Validation::ValiderNomDevoirExistant($_GET['nomDevoir'], $_GET['idDevoir']);
							Validation::ValiderNoteMaxExistante($_GET['noteMax'], $_GET['idDevoir']);
							Validation::ValiderCoefficientDevoirExistant($_GET['coefficient'], $_GET['idDevoir']);
							$idDevoir = $_GET['idDevoir'];
							$nomDevoir = $_GET['nomDevoir'];
							$noteMax = $_GET['noteMax'];
							$coefficient = $_GET['coefficient'];
							$date = explode("-",$_GET['date']);
							$anneeDevoir = $date[0];
							$moisDevoir = $date[1];
							$jourDevoir = $date[2];
						} else { 
							$idDevoir = $listeDevoirsDuGroupe[0]->getIdDevoir();
							$nomDevoir = $listeDevoirsDuGroupe[0]->getNomDevoir();
							$noteMax = $listeDevoirsDuGroupe[0]->getNoteMax();
							$coefficient = $listeDevoirsDuGroupe[0]->getCoefficient();
							$date = explode("-",$listeDevoirsDuGroupe[0]->getDate());
							$anneeDevoir = $date[0];
							$moisDevoir = $date[1];
							$jourDevoir = $date[2];
						}
						
						$listeNotesDuDevoir = $mdlEnseignant->GetNotesDuDevoir($idDevoir, $listeEleves);
						$noteTotal = 0;
						foreach($listeNotesDuDevoir['note'] as $note)
							$noteTotal = $noteTotal + $note->getNote();
						$moyenneDevoir = $noteTotal/count($listeNotesDuDevoir['note']);
					}
				}
			}
			require('./Vue/vuesGestion/vueGestionNotes.php');
		}
	}
	
	public function AjouterNotes(){
		
		if(isset($_POST['idDiv'], $_POST['nomDevoir'], $_POST['nombreEleve'], $_POST['idFormation'], $_POST['noteMax'], $_POST['coefficient'], $_POST['idGroupe'], $_POST['jourDevoir'],
				 $_POST['moisDevoir'], $_POST['anneeDevoir'],$_POST['nomGroupe'],$_POST['nomCentre'], $_POST['idCentre'])){
			Validation::ValiderIdGroupe($_POST['idGroupe']);
			Validation::ValiderIdCentre($_POST['idCentre']);
			Validation::ValiderNomGroupe($_POST['nomGroupe']);
			Validation::ValiderNomCentre($_POST['nomCentre']);
			$_GET['idGroupe'] = $_POST['idGroupe'];
			$_GET['nomGroupe'] = $_POST['nomGroupe'];
			$_GET['idCentre'] = $_POST['idCentre'];
			$_GET['nomCentre'] = $_POST['nomCentre'];
			
			for($i = 0; $i <= $_POST['nombreEleve']; $i++){
				if(isset($_POST["note".$i])){
					try{
						Validation::ValiderNote($_POST["note".$i],$_POST['noteMax']);
						if(empty($_POST["note".$i])){ $_POST["note".$i] = 'NN'; }
						$tabNotes[] = $_POST["note".$i];
					} catch (Exception $e) { 
						if(!in_array($e->getMessage(),$this->tableauErreurs))
							$this->tableauErreurs[] = $e->getMessage(); 
					}
				}
			}
			
			try{
				Validation::ValiderNomDevoir($_POST['nomDevoir']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNoteMaximumDevoir($_POST['noteMax']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderCoefficientDevoir($_POST['coefficient']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderIdFormationExistante($_POST['idFormation']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			$dateDevoir = $_POST['anneeDevoir']."-".$_POST['moisDevoir']."-".$_POST['jourDevoir'];
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$listeEleves = $mdlEnseignant->GetElevesParGroupe($_POST['idGroupe']);
				$mdlEnseignant->AjouterNotes($_POST['nomDevoir'], $_POST['noteMax'],$_POST['coefficient'],$_POST['idFormation'],$listeEleves,$tabNotes,$_SESSION['login'],$dateDevoir);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterNotes";
			$ctrlEnseignant = new ControleurEnseignant($this->tableauErreurs);
		}
	}
	
	public function SupprimerEleve(){
	
		if(isset($_GET['loginEleve'])){
			Validation::ValiderLoginEtudiant($_GET['loginEleve']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerEleve($_GET['loginEleve']);
			$_REQUEST['action'] = "ConsulterMesEleves";
			$ctrlEnseignant = new ControleurEnseignant(null);
		}
	}
	
	public function SupprimerDevoir(){
	
		if(isset($_GET['idDevoir'],$_GET['idGroupe'],$_GET['nomGroupe'],$_GET['idCentre'],$_GET['nomCentre'])){
			Validation::ValiderIdGroupe($_GET['idGroupe']);
			Validation::ValiderNomGroupe($_GET['nomGroupe']);
			Validation::ValiderIdCentre($_GET['idCentre']);
			Validation::ValiderNomCentre($_GET['nomCentre']);
			Validation::ValiderIdDevoir($_GET['idDevoir']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerDevoir($_GET['idDevoir']);
			$_REQUEST['action'] = "ConsulterNotes";
			new ControleurEnseignant(null);
		}
	}
	
	public function ModifierNotes(){
		
		if(isset($_POST['idDiv'], $_POST['nombreEleve'], $_POST['idGroupe'], $_POST['nomGroupe'], $_POST['idCentre'], $_POST['nomCentre'], $_POST['idFormationDevoirModifie'], $_POST['nomDevoirModifie'],
				 $_POST['jourDevoirModifie'], $_POST['moisDevoirModifie'], $_POST['anneeDevoirModifie'], $_POST['noteMaxModifie'], $_POST['coefficientModifie'], $_POST['idDevoir'])){
				 
			Validation::ValiderIdGroupe($_POST['idGroupe']);
			Validation::ValiderNomGroupe($_POST['nomGroupe']);
			Validation::ValiderIdCentre($_POST['idCentre']);
			Validation::ValiderNomCentre($_POST['nomCentre']);
			Validation::ValiderIdDevoir($_POST['idDevoir']);
			$_GET['idGroupe'] = $_POST['idGroupe'];
			$_GET['nomGroupe'] = $_POST['nomGroupe'];
			$_GET['nomCentre'] = $_POST['nomCentre'];
			$_GET['idCentre'] = $_POST['idCentre'];
			for($i = 0; $i <= $_POST['nombreEleve']; $i++){
				if(isset($_POST["note".$i])){
					try{
						Validation::ValiderNote($_POST["note".$i],$_POST['noteMaxModifie']);
						if(empty($_POST["note".$i])){ $_POST["note".$i] = 'NN'; }
						$tabNotes[] = $_POST["note".$i];
					} catch (Exception $e) { 
						if(!in_array($e->getMessage(),$this->tableauErreurs))
						$this->tableauErreurs[] = $e->getMessage(); 
					}
				}
			}
			
			try{
				Validation::ValiderNomDevoir($_POST['nomDevoirModifie']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderNoteMaximumDevoir($_POST['noteMaxModifie']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			try{
				Validation::ValiderCoefficientDevoir($_POST['coefficientModifie']);
			} catch (Exception $e) { $this->tableauErreurs[] = $e->getMessage(); }
			
			$_POST['dateDevoirModifie'] = $_POST['anneeDevoirModifie']."-".$_POST['moisDevoirModifie']."-".$_POST['jourDevoirModifie'];
			
			if(empty($this->tableauErreurs)){
				$mdlEnseignant = new ModeleEnseignant();
				$listeEleves = $mdlEnseignant->GetElevesParGroupe($_POST['idGroupe']);
				$mdlEnseignant->ModifierNotes($_POST['idDevoir'], $_POST['nomDevoirModifie'], $_POST['noteMaxModifie'],$_POST['coefficientModifie'],$_POST['idFormationDevoirModifie'],$listeEleves,$tabNotes,$_POST['dateDevoirModifie']);
			} else { $this->tableauErreurs['erreurAfficherPopup'] = $_POST['idDiv']; }
			$_REQUEST['action'] = "ConsulterNotes";
			new ControleurEnseignant($this->tableauErreurs);
				 
		}
	}
	
	public function ConsulterDemandesInscription(){
		
		if(isset($_SESSION['login'])){
			$loginPersonneConnectee = $_SESSION['login'];
			if($_SESSION['login'] == "habendaoud"){ 
				$loginSuperEnseignant = $_SESSION['login'];
				$mdlEnseignant = new ModeleEnseignant();
				$nbDemandes = $mdlEnseignant->GetNbDemandesInscription();
				if($nbDemandes > 0){ 
					$nouvellesDemandes = true;
					$inscriptions = $mdlEnseignant->GetDemandesInscriptions();
				}
			} else { throw new Exception; }
		}
		$actionConsulterEleves = "ConsulterMesEleves";
		if(isset($_SESSION['role'])){	
			if($_SESSION['role'] == 'enseignant'){ $roleEnseignant = $_SESSION['role']; }
			if($_SESSION['role'] == 'chefcentre'){ $roleChefCentre = $_SESSION['role']; $actionConsulterEleves = "ConsulterMesElevesCC"; }
			if($_SESSION['role'] == 'etudiant'){ $roleEtudiant = $_SESSION['role']; }
		}	
		$mdlVisiteur = new ModeleVisiteur();
		$listeForums = $mdlVisiteur->GetListeForums();	
			
		require('./Vue/vuesGestion/vueGestionDemandesInscription.php');
	}
	
	public function DeclinerDemandeInscription(){
	
		if(isset($_GET['loginPersonne'])){
			Validation::ValiderLoginPersonne($_GET['loginPersonne']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->DeclinerDemandeInscription($_GET['loginPersonne']);
			$_REQUEST['action'] = "ConsulterDemandesInscription";
			new ControleurEnseignant(null);
		}
	}
	
	public function ValiderDemandeInscription(){
	
		if(isset($_GET['loginPersonne'])){
			Validation::ValiderLoginPersonne($_GET['loginPersonne']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->ValiderDemandeInscription($_GET['loginPersonne']);
			$_REQUEST['action'] = "ConsulterDemandesInscription";
			new ControleurEnseignant(null);
		}
	}
	
	public function SupprimerAvis(){
	
		if(isset($_GET['loginPersonne'], $_GET['idFormation'], $_GET['idFormation'], $_GET['nomEnseignant'], $_GET['prenomEnseignant'])){
			Validation::ValiderLoginPersonne($_GET['loginPersonne']);
			Validation::ValiderIdFormation($_GET['idFormation']);
			$mdlEnseignant = new ModeleEnseignant();
			$mdlEnseignant->SupprimerAvis($_GET['loginPersonne'], $_GET['idFormation']);
			$_REQUEST['action'] = "ConsulterAvis";
			new ControleurEtudiant(null);
		}
	}
}
?>