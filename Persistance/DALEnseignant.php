<?php
Autoloader::getInstance()->autoload(array('BD'));

class DALEnseignant{
	
	public function __construct(){}
	
	/*** FORMATION ***/
	public function GetNbEnseignant(){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM personne WHERE role = 'enseignant'";
		$parametre = array();
		$statement = $BD->query($requete,$parametre);
		$nbEnseignant = $BD->getResult($statement);
		return $nbEnseignant[0];
	}
	
	public function GetListeEnseignants($pageCourante){

		$BD = BD::getInstance();
		$requete = "SELECT login,nom,prenom,email,numTel,role FROM personne WHERE role = 'enseignant' LIMIT ?,30";
		$position = ($pageCourante-1)*30;	
		$parametre = array('1' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetNbFormationEnseignant($loginEnseignant){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM enseigner WHERE loginPersonne = ?";
		$parametre = array('1' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbFormation = $BD->getResult($statement);
		return $nbFormation[0];
	}
	
	public function GetFormationsEnseignant($login){
		
		$BD = BD::getInstance();
		$requete = "SELECT F.idFormation, F.nomFormation, F.descriptif, F.nomTypeFormation
					FROM formation F, enseigner E
					WHERE F.idFormation = E.idFormation 
					AND E.loginPersonne = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetFormationsEnseignantParPage($login,$pageCouranteFormation){
		
		$BD = BD::getInstance();
		$requete = "SELECT F.idFormation, F.nomFormation, F.descriptif, F.nomTypeFormation
						FROM formation F, enseigner E
						WHERE F.idFormation = E.idFormation 
						AND E.loginPersonne = ?
						LIMIT ?,5";
		$position = ($pageCouranteFormation-1)*5;
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetListeTypesFormation(){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM typeformation";
		$parametre = array();
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterFormation($nomFormation,$descriptif,$login,$nomtype){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO formation (nomFormation,descriptif,nomTypeFormation) VALUES (?,?,?)";
		$parametre = array('1' => array($nomFormation, PDO::PARAM_STR),
						   '2' => array($descriptif, PDO::PARAM_STR),
						   '3' => array($nomtype, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete2 = "SELECT MAX(idFormation) FROM formation WHERE nomFormation = ? AND descriptif = ? AND nomTypeFormation = ?";
		$parametre2 = array('1' => array($nomFormation, PDO::PARAM_STR),
						    '2' => array($descriptif, PDO::PARAM_STR),
						    '3' => array($nomtype, PDO::PARAM_STR));
		$statement2 = $BD->query($requete2,$parametre2);
		$idFormation = $BD->getResult($statement2);
				
		$requete3 = "INSERT INTO enseigner (idFormation,loginPersonne) VALUES (?,?)";
		$parametre3 = array('1' => array($idFormation[0], PDO::PARAM_INT),
							'2' => array($login, PDO::PARAM_STR));
		$statement3 = $BD->query($requete3,$parametre3);
	}	
	
	public function ModifierFormation($idFormation, $nomFormation, $description, $nomTypeFormation){
		
		$BD = BD::getInstance();
		$requete = "UPDATE formation SET nomFormation = ?, descriptif = ?, nomTypeFormation = ? WHERE idFormation = ?";
		$parametre = array('1' => array($nomFormation, PDO::PARAM_STR),
						   '2' => array($description, PDO::PARAM_STR),
						   '3' => array($nomTypeFormation, PDO::PARAM_STR),
						   '4' => array($idFormation, PDO::PARAM_INT));
		$BD->query($requete, $parametre);
	}
	
	public function AjouterTypeFormation($nomType){
		
		$BD = BD::getInstance();
		$requete = "INSERT INTO typeformation (nomTypeFormation) VALUES (?)";
		$parametre = array('1' => array($nomType, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
	}
		
	public function SupprimerFormation($idFormation,$loginPersonne){
		
		$BD = BD::getInstance();
		
		$requete = "DELETE FROM enseigner WHERE idFormation = ? AND loginPersonne = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT),
					       '2' => array($loginPersonne, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete2 = "DELETE FROM intervention WHERE idFormation = ? AND loginPersonne = ?";
		$parametre2 = array('1' => array($idFormation, PDO::PARAM_INT),
					       '2' => array($loginPersonne, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete3 = "DELETE FROM formation WHERE idFormation = ?";
		$parametre3 = array('1' => array($idFormation, PDO::PARAM_INT));
		$statement3 = $BD->query($requete3, $parametre3);
	}		
	/* FORUM */
	public function SupprimerForum($idForum){
		
		$BD = BD::getInstance();
		
		$requete = "SELECT idSujet FROM sujet WHERE idForum = ?";
		$parametre = array('1' => array($idForum, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		$idSujets = $BD->getResults($statement);
		
		if(!empty($idSujets)){
			$requete2 = "DELETE FROM message WHERE idSujet = ?";
			foreach($idSujets as $idSujet){
				$parametre2 = array('1' => array(intval($idSujet), PDO::PARAM_INT));
				$statement2 = $BD->query($requete2, $parametre2);
			}
		}
		
		$requete3 = "DELETE FROM sujet WHERE idForum = ?";
		$parametre3 = array('1' => array($idForum, PDO::PARAM_INT));
		$statement3 = $BD->query($requete3, $parametre3);
		
		$requete4 = "DELETE FROM forum WHERE idForum = ?";
		$parametre4 = array('1' => array($idForum, PDO::PARAM_INT));
		$statement4 = $BD->query($requete4, $parametre4);
	}
	
	public function AjouterForum($titreForum){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO forum (intitule) VALUES (?)";
		$parametre = array('1' => array($titreForum, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
	
	public function SupprimerSujet($idSujet){
		
		$BD = BD::getInstance();
			
		$requete = "DELETE FROM message WHERE idSujet = ?";
		$parametre = array('1' => array($idSujet, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		
		$requete2 = "DELETE FROM sujet WHERE idSujet = ?";
		$parametre2 = array('1' => array($idSujet, PDO::PARAM_INT));
		$statement2 = $BD->query($requete2, $parametre2);
	}
	
	public function SupprimerMessage($idMessage){
		
		$BD = BD::getInstance();
			
		$requete = "DELETE FROM message WHERE idMessage = ?";
		$parametre = array('1' => array($idMessage, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
	}
					
	/** AGENDA **/
	public function GetNbInterventionsEnseignant($login){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM intervention WHERE loginPersonne = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$NbInterventionsEnseignant = $BD->getResult($statement);
		return $NbInterventionsEnseignant[0];
	}
	
	public function GetInterventionsEnseignant($login,$pageCourante){
		echo $login, $pageCourante;
		$BD = BD::getInstance();
		$requete = "SELECT idIntervention, dateDebut, dateFin, salle, F.idFormation, F.nomFormation, CF.idCentre, CF.nomCentre, CF.villeCentre, I.loginPersonne
					FROM formation F, intervention I, centreformation CF
					WHERE F.idFormation = I.idFormation
					AND CF.idCentre = I.idCentre
					AND I.loginPersonne = ?
					ORDER BY dateDebut
					LIMIT ?,25";
		$position = ($pageCourante-1) * 25;
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterIntervention($dateDebut,$dateFin,$nbRepetitions,$salle,$loginPersonne,$idCentre,$idFormation){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO intervention (dateDebut, dateFin, salle, idFormation, idCentre, loginPersonne) VALUES (?,?,?,?,?,?)";
		for($i = 0; $i < $nbRepetitions; $i++){
			$parametre = array('1' => array($dateDebut, PDO::PARAM_STR),
							   '2' => array($dateFin, PDO::PARAM_STR),
							   '3' => array($salle, PDO::PARAM_STR),
							   '4' => array($idFormation, PDO::PARAM_INT),
							   '5' => array($idCentre, PDO::PARAM_INT),
							   '6' => array($loginPersonne, PDO::PARAM_STR));
			$statement = $BD->query($requete, $parametre);
			$dateDebut = date('Y-m-d H:i:s', strtotime("$dateDebut +7 day"));
			$dateFin = date('Y-m-d H:i:s', strtotime("$dateFin +7 day"));
		}
	}
	
	public function SupprimerIntervention($idIntervention){
		
		$BD = BD::getInstance();
			
		$requete = "DELETE FROM intervention WHERE idIntervention = ?";
		$parametre = array('1' => array($idIntervention, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
	}
	
	public function ViderAgenda(){
	
		$BD = BD::getInstance();
		$requete = "DELETE FROM intervention";
		$parametre = array();
		$statement = $BD->query($requete, $parametre);
	}
	
	/* CENTRE FORMATION */
	public function ModifierCentreFormation($idCentre,$nomCentre, $villeCentre, $rueCentre, $cpCentre, $login){
	
		$BD = BD::getInstance();
		echo $nomCentre, $villeCentre, $rueCentre, $cpCentre, $login, $idCentre;
		$requete = "UPDATE centreformation SET nomCentre = ?, rueCentre = ?, villeCentre = ?, codePostal = ?, loginPersonne = ? WHERE idCentre = ?";
		$parametre = array('1' => array($nomCentre, PDO::PARAM_STR),
						   '2' => array($rueCentre, PDO::PARAM_STR),
						   '3' => array($villeCentre, PDO::PARAM_STR),
						   '4' => array($cpCentre, PDO::PARAM_STR),
						   '5' => array($login, PDO::PARAM_STR),
						   '6' => array($idCentre, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
	}
	
	public function GetNbCentresFormationEnseignant($loginEnseignant){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM travailler WHERE loginPersonne = ?";
		$parametre = array('1' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$NbCentresFormationEnseignant = $BD->getResult($statement);
		return $NbCentresFormationEnseignant[0];
	}
	
	public function GetCentresFormationEnseignant($login){
	
		$BD = BD::getInstance();
		$requete = "SELECT CF.idCentre, nomCentre, rueCentre, villeCentre, codePostal, CF.loginPersonne
						FROM centreformation CF, travailler T
						WHERE CF.idCentre = T.idCentre 
						AND T.loginPersonne = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetCentresFormationEnseignantParPage($login,$pageCourante){
	
		$BD = BD::getInstance();
		$requete = "SELECT CF.idCentre, nomCentre, rueCentre, villeCentre, codePostal, CF.loginPersonne
						FROM centreformation CF, travailler T
						WHERE CF.idCentre = T.idCentre 
						AND T.loginPersonne = ?
						LIMIT ?,20";
		$position = ($pageCourante-1)*20;
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
							   
	public function GetChefsCentre(){
	
		$BD = BD::getInstance();
		$requete = "SELECT login, nom, prenom, email, numTel, role FROM personne WHERE role ='chefcentre'";
		$parametre =  array();
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function GetListeCentres(){
	
		$BD = BD::getInstance();
		$requete = "SELECT * from centreformation";
		$parametre = array();
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
		
	}
	
	public function GetInformationsChefCentre($idCentre){
	
		$BD = BD::getInstance();
		$requete = "SELECT login, nom, prenom, email, numTel, role 
					FROM personne P, centreformation CF
					WHERE P.login = CF.loginPersonne
					AND idCentre = ?
					GROUP BY login";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResult($statement);
	}
	
	public function SupprimerCentreFormation($idCentre,$loginPersonne){
			
		$BD = BD::getInstance();

		$requete = "DELETE FROM intervention WHERE idCentre = ? AND loginPersonne = ?";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT),
					       '2' => array($loginPersonne, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete2 = "DELETE FROM travailler WHERE idCentre = ? AND loginPersonne = ?";
		$parametre2 = array('1' => array($idCentre, PDO::PARAM_INT),
					        '2' => array($loginPersonne, PDO::PARAM_STR));
		$statement2 = $BD->query($requete2,$parametre2);
		
		$requete3 = "DELETE FROM centreformation WHERE idCentre = ?";
		$parametre3 = array('1' => array($idCentre, PDO::PARAM_INT));
		$statement3 = $BD->query($requete3,$parametre3);
	}	

	public function AjouterCentreFormation($login,$nomCentre,$villeCentre,$rueCentre,$cpCentre,$loginChefCentre,$nomChefCentre,$prenomChefCentre,$email,$tel,$loginCC,$passwordCC){
	
		$BD = BD::getInstance();
		if(!empty($nomChefCentre) && !empty($prenomChefCentre) && !empty($email) && !empty($tel) && !empty($loginCC) && !empty($passwordCC)){
			$requete = "INSERT INTO personne (login, password, nom, prenom, email, numTel, role) VALUES (?,?,?,?,?,?,'chefcentre')";
			$parametre = array('1' => array($loginCC, PDO::PARAM_STR),
							   '2' => array($passwordCC, PDO::PARAM_STR),
							   '3' => array($nomChefCentre, PDO::PARAM_STR),
							   '4' => array($prenomChefCentre, PDO::PARAM_STR),
							   '5' => array($email, PDO::PARAM_STR),
							   '6' => array($tel, PDO::PARAM_STR));
			$statement = $BD->query($requete,$parametre);
			$loginChefCentre = $loginCC;
		}
		
		$requete3 = "INSERT INTO centreformation (nomCentre, rueCentre, villeCentre, codePostal, loginPersonne) VALUES (?,?,?,?,?)";
		$parametre3 = array('1' => array($nomCentre, PDO::PARAM_STR),
							'2' => array($rueCentre, PDO::PARAM_STR),
							'3' => array($villeCentre, PDO::PARAM_STR),
							'4' => array($cpCentre, PDO::PARAM_STR),
							'5' => array($loginChefCentre, PDO::PARAM_STR));
		$statement3 = $BD->query($requete3,$parametre3);
			
		$requete4 = "SELECT MAX(idCentre) FROM centreformation WHERE nomCentre = ? AND villeCentre = ? AND rueCentre = ? AND codePostal = ? AND loginPersonne = ?";
		$parametre4 = array('1' => array($nomCentre, PDO::PARAM_STR),
							'2' => array($villeCentre, PDO::PARAM_STR),
							'3' => array($rueCentre, PDO::PARAM_STR),
							'4' => array($cpCentre, PDO::PARAM_STR),
							'5' => array($loginChefCentre, PDO::PARAM_STR));
		$statement4 = $BD->query($requete4,$parametre4);
		$idCentre = $BD->getResult($statement4);
		
		$requete5 = "INSERT INTO travailler (idCentre, loginPersonne) VALUES (?,?)";
		$parametre5 = array('1' => array($idCentre[0], PDO::PARAM_INT),
							'2' => array($login, PDO::PARAM_STR));
		$statement5 = $BD->query($requete5,$parametre5);
	}
	
	public function AjouterCentreFormationExistant($idCentre,$loginEnseignant){
		
		$BD = BD::getInstance();
		$requete = "INSERT INTO travailler (idCentre, loginPersonne) VALUES (?,?)";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT),
						   '2' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
	}
	
	/*** ELEVES ***/
	
	public function GetNbGroupesEnseignant($loginEnseignantConnecte){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM appartenir WHERE loginPersonne = ?";
		$parametre = array('1' => array($loginEnseignantConnecte, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbGroupesEnseignant = $BD->getResult($statement);
		return $nbGroupesEnseignant[0];
	}
	
	public function GetGroupesEnseignantParCentre($loginEnseignantConnecte,$idCentre,$pageCourante){
	
		$BD = BD::getInstance();
		$requete = "SELECT G.idGroupe, nomGroupe, anneeEtude, anneeEntree, anneeSortie, idCentre
					FROM groupe G, appartenir ER
					WHERE G.idGroupe = ER.idGroupe
					AND G.idCentre = ?
					AND ER.loginPersonne = ?
					LIMIT ?,6";
		$position = ($pageCourante-1)*6;
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT),
						   '2' => array($loginEnseignantConnecte, PDO::PARAM_STR),
						   '3' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function GetElevesParGroupe($idGroupe){
	
		$BD = BD::getInstance();
		$requete = "SELECT login, nom, prenom, email, numTel, role
					FROM personne P, appartenir A
					WHERE P.role = 'etudiant'
					AND P.login = A.loginPersonne
					AND A.idGroupe = ?
					ORDER BY P.nom";
		$parametre = array('1' => array($idGroupe, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterClasse($idCentre,$nomClasse,$anneeEtude,$tEleves,$loginEnseignant,$anneeEntree,$anneeSortie){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO groupe (nomGroupe, anneeEtude, anneeEntree, anneeSortie, idCentre) VALUES (?,?,?,?,?)";
		$parametre = array('1' => array($nomClasse, PDO::PARAM_STR),
						   '2' => array($anneeEtude, PDO::PARAM_INT),
						   '3' => array($anneeEntree, PDO::PARAM_INT),
						   '4' => array($anneeSortie, PDO::PARAM_INT),
						   '5' => array($idCentre, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		
		$requete = "SELECT MAX(idGroupe) FROM groupe WHERE nomGroupe = ? AND anneeEtude = ? AND idCentre = ? AND anneeEntree = ? AND anneeSortie = ?";
		$parametre = array('1' => array($nomClasse, PDO::PARAM_STR),
						   '2' => array($anneeEtude, PDO::PARAM_INT),
						   '3' => array($idCentre, PDO::PARAM_INT),
						   '4' => array($anneeEntree, PDO::PARAM_INT),
						   '5' => array($anneeSortie, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		$idDernierGroupe = $BD->getResult($statement);
					
		$requete2 = "INSERT INTO personne (login, password, prenom, nom, role) VALUES (?,?,?,?,'etudiant')";
		if(!empty($tEleves)){
			foreach($tEleves as $eleve){
				$parametre2 = array('1' => array($eleve[0], PDO::PARAM_STR),
									'2' => array($eleve[1], PDO::PARAM_STR),
									'3' => array($eleve[2], PDO::PARAM_STR),
									'4' => array($eleve[3], PDO::PARAM_STR));
				$statement2 = $BD->query($requete2,$parametre2);
				
				$requete3 = "INSERT INTO appartenir (idGroupe, loginPersonne) VALUES (?,?)";
				$parametre3 = array('1' => array($idDernierGroupe[0], PDO::PARAM_INT),
									'2' => array($eleve[0], PDO::PARAM_STR));
				$statement3 = $BD->query($requete3,$parametre3);
			}
		}
		
		$requete4 = "INSERT INTO appartenir (idGroupe, loginPersonne) VALUES (?,?)";
		$parametre4 = array('1' => array($idDernierGroupe[0], PDO::PARAM_INT),
								'2' => array($loginEnseignant, PDO::PARAM_STR));
		$statement4 = $BD->query($requete4,$parametre4);
	}	
	
	public function AjouterUnEtudiant($idGroupe,$nomEtudiant,$prenomEtudiant,$login,$password){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO personne (login, password, nom, prenom, role) VALUES (?,?,?,?,'etudiant')";
		$parametre = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($password, PDO::PARAM_STR),
						   '3' => array($nomEtudiant, PDO::PARAM_STR),
						   '4' => array($prenomEtudiant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete2 = "INSERT INTO appartenir (idGroupe, loginPersonne) VALUES (?,?)";
		$parametre2 = array('1' => array($idGroupe, PDO::PARAM_INT),
								'2' => array($login, PDO::PARAM_STR));
		$statement2 = $BD->query($requete2,$parametre2);
	}
	
	public function SupprimerGroupe($idGroupe,$loginEnseignant){

		$BD = BD::getInstance();
		$requete = "DELETE FROM appartenir WHERE idGroupe = ? AND loginPersonne = ?";
		$parametre = array('1' => array($idGroupe, PDO::PARAM_INT),
						   '2' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		
		$requete2 = "SELECT COUNT(*) 
					 FROM appartenir A, personne P 
					 WHERE idGroupe = ?
					 AND A.loginPersonne = P.login
					 AND P.role = 'enseignant'";
		$parametre2 = array('1' => array($idGroupe,PDO::PARAM_INT));
		$statement2 = $BD->query($requete2,$parametre2);
		$resultat = $BD->getResult($statement2);
		
		if($resultat[0] == 0){
			$requete3 = "SELECT loginPersonne FROM appartenir WHERE idGroupe = ?";
			$parametre3 = array('1' => array($idGroupe, PDO::PARAM_INT));
			$statement3 = $BD->query($requete3,$parametre3);
			$logins = $BD->getResults($statement3);
			foreach($logins as $login)
				$tLogins[] = $login[0];
				
			$requete4 = "DELETE FROM appartenir WHERE idGroupe = ?";
			$parametre4 = array('1' => array($idGroupe, PDO::PARAM_INT));
			$statement4 = $BD->query($requete4,$parametre4);
			
			$requete5 = "DELETE FROM groupe WHERE idGroupe = ?";
			$parametre5 = array('1' => array($idGroupe, PDO::PARAM_INT));
			$statement = $BD->query($requete5,$parametre5);
			
			return $tLogins;
		}
	}
	
	public function ChargerGroupeParCentre($idCentre){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM groupe WHERE idCentre = ? ORDER BY nomGroupe";
		$parametre = array('1' => array($idCentre, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function AjouterGroupeExistant($idGroupe,$loginEnseignant){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO appartenir (idGroupe, loginPersonne) VALUES (?,?)";
		$parametre = array('1' => array($idGroupe, PDO::PARAM_INT),
						   '2' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
	}
	
	public function AjouterPlusieursEleves($idGroupe, $tableauEleves){
	
		$BD = BD::getInstance();		
		$requete = "INSERT INTO personne (login, password, prenom, nom, role) VALUES (?,?,?,?,'etudiant')";
		foreach($tableauEleves as $eleve){
			$parametre = array('1' => array($eleve[0], PDO::PARAM_STR),
							   '2' => array($eleve[1], PDO::PARAM_STR),
							   '3' => array($eleve[2], PDO::PARAM_STR),
							   '4' => array($eleve[3], PDO::PARAM_STR));
			$statement = $BD->query($requete,$parametre);
			
			$requete2 = "INSERT INTO appartenir (idGroupe, loginPersonne) VALUES (?,?)";
			$parametre2 = array('1' => array($idGroupe, PDO::PARAM_INT),
								'2' => array($eleve[0], PDO::PARAM_STR));
			$statement2 = $BD->query($requete2,$parametre2);
		}
	}
	
	public function AjouterNotes($nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$loginEnseignant,$date){
	
		$BD = BD::getInstance();
		$requete = "INSERT INTO devoir (titreDevoir, dateDevoir, noteMax, coefficient, idFormation, loginPersonne) VALUES (?,?,?,?,?,?)";
		$parametre = array('1' => array($nomDevoir, PDO::PARAM_STR),
						   '2' => array($date, PDO::PARAM_STR),
						   '3' => array($noteMax, PDO::PARAM_INT),
						   '4' => array($coefficient, PDO::PARAM_INT),
						   '5' => array($idFormation, PDO::PARAM_INT),
						   '6' => array($loginEnseignant, PDO::PARAM_STR));
		$statement = $BD->query($requete, $parametre);
		
		$requete2 = "SELECT MAX(idDevoir) FROM devoir WHERE noteMax = ? AND coefficient = ? AND idFormation = ? AND titreDevoir = ? AND loginPersonne = ? AND dateDevoir = ?";
		$parametre2 = array('1' => array($noteMax, PDO::PARAM_INT),
						   '2' => array($coefficient, PDO::PARAM_INT),
						   '3' => array($idFormation, PDO::PARAM_INT),
						   '4' => array($nomDevoir, PDO::PARAM_STR),
						   '5' => array($loginEnseignant, PDO::PARAM_STR),
						   '6' => array($date, PDO::PARAM_STR));
		$statement2 = $BD->query($requete2, $parametre2);
		$idDevoir = $BD->getResult($statement2);
		
		$requete3 = "INSERT INTO avoirnote (note, loginPersonne, idDevoir) VALUES (?,?,?)";	
		$i = 0;
		foreach($tabNotes as $note){
			$parametre3 = array('1' => array($note, PDO::PARAM_STR),
								'2' => array($Eleves[$i]->getLogin(), PDO::PARAM_STR),
								'3' => array($idDevoir[0], PDO::PARAM_INT));
			$statement3 = $BD->query($requete3, $parametre3);
			$i++;
		}
	}
	
	public function ModifierNotes($idDevoir,$nomDevoir,$noteMax,$coefficient,$idFormation,$Eleves,$tabNotes,$date){
	
		$BD = BD::getInstance();
		$requete = "UPDATE devoir SET titreDevoir = ?, dateDevoir = ?, noteMax = ?, coefficient = ?, idFormation = ? WHERE idDevoir = ?";
		$parametre = array('1' => array($nomDevoir, PDO::PARAM_STR),
						   '2' => array($date, PDO::PARAM_STR),
						   '3' => array($noteMax, PDO::PARAM_INT),
						   '4' => array($coefficient, PDO::PARAM_INT),
						   '5' => array($idFormation, PDO::PARAM_INT),
						   '6' => array($idDevoir, PDO::PARAM_INT));
		$BD->query($requete, $parametre);
		
		$requete2 = "UPDATE avoirnote SET note = ? WHERE loginPersonne = ? AND idDevoir = ?";
		$i = 0;
		foreach($tabNotes as $note){
			$parametre2 = array('1' => array($note, PDO::PARAM_STR),
								'2' => array($Eleves[$i]->getLogin(), PDO::PARAM_STR),
								'3' => array($idDevoir, PDO::PARAM_INT));
			$BD->query($requete2, $parametre2);
			$i++;
		}
	}
	
	public function CountNbFormationsEvalueesDuGroupe($loginEleveDuGroupe){
		
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(DISTINCT(idFormation))
					FROM devoir D, avoirnote AN
					WHERE AN.idDevoir = D.idDevoir
					AND AN.loginPersonne = ?";
		$parametre = array('1' => array($loginEleveDuGroupe, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbFormationsEvaluees = $BD->getResult($statement);
		return $nbFormationsEvaluees[0];
	}
	
	public function GetListeFormationsEvalueesDuGroupe($loginEleveDuGroupe,$pageCourante){
		
		$BD = BD::getInstance();
		$requete = "SELECT F.idFormation, nomFormation, descriptif, nomTypeFormation
					FROM formation F, devoir D, avoirnote AN
					WHERE F.idFormation = D.idFormation
					AND AN.idDevoir = D.idDevoir
					AND AN.loginPersonne = ?	
					GROUP BY F.idFormation
					LIMIT ?,20";			
		$position = ($pageCourante-1)*20;
		$parametre = array('1' => array($loginEleveDuGroupe, PDO::PARAM_STR),
						   '2' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function CountDevoirsParFormationParGroupe($idFormation,$loginEleveDuGroupe){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) 
					FROM devoir D, avoirnote AN 
					WHERE D.idDevoir = AN.idDevoir 
					AND D.idFormation = ? 
					AND AN.loginPersonne = ?";
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT),
						   '2' => array($loginEleveDuGroupe, PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		$nbDevoirs = $BD->getResult($statement);
		return $nbDevoirs[0];
	}
	
	public function GetDevoirsParFormationParGroupe($idFormation,$pageCourante,$loginEleveDuGroupe){
	
		$BD = BD::getInstance();
		$requete = "SELECT * FROM devoir D, avoirnote AN 
					WHERE D.idFormation = ? 
					AND D.idDevoir = AN.idDevoir 
					AND AN.loginPersonne = ? 
					LIMIT ?,20";
		$position = ($pageCourante-1)*20;
		$parametre = array('1' => array($idFormation, PDO::PARAM_INT),
						   '2' => array($loginEleveDuGroupe, PDO::PARAM_STR),
						   '3' => array($position, PDO::PARAM_INT));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResults($statement);
	}
	
	public function GetNotesDuDevoir($idDevoir, $eleve){
	
		$BD = BD::getInstance();
		$requete = "SELECT idNote, note, loginPersonne, idDevoir FROM avoirnote WHERE idDevoir = ? AND loginPersonne = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT),
						   '2' => array($eleve->getLogin(), PDO::PARAM_STR));
		$statement = $BD->query($requete,$parametre);
		return $BD->getResult($statement);
	}
	
	public function SupprimerEleve($loginEleve){
	
		$BD = BD::getInstance();
		$parametre = array('1' => array($loginEleve, PDO::PARAM_STR));
		
		$requete1 = "DELETE FROM message WHERE loginPersonne = ?";
		$statement = $BD->query($requete1,$parametre);
		
		$requete2 = "DELETE FROM sujet WHERE loginPersonne = ?";
		$statement = $BD->query($requete2,$parametre);
				
		$requete3bis = "DELETE FROM appartenir WHERE loginPersonne = ?";
		$statement = $BD->query($requete3bis,$parametre);
		
		$requete4 = "DELETE FROM avis WHERE loginPersonne = ?";
		$statement = $BD->query($requete4,$parametre);
		
		$requete5 = "SELECT idDevoir FROM avoirnote WHERE loginPersonne = ?";
		$statement5 = $BD->query($requete5,$parametre);
		$idDevoirs = $BD->getResult($statement5);
		
		$requete6 = "DELETE FROM avoirnote WHERE loginPersonne = ?";
		$statement6 = $BD->query($requete6,$parametre);
		
		$requete7 = "SELECT COUNT(*) FROM avoirnote WHERE idDevoir = ?";
		if(!empty($idDevoirs)){
			foreach($idDevoirs as $iddevoir){
				$parametre7 = array('1' => array($iddevoir, PDO::PARAM_INT));
				$statement7 = $BD->query($requete7,$parametre7);
				$nbIdDevoir = $BD->getResult($statement7);
				if($nbIdDevoir[0] == 0){
					$requete8 = "DELETE FROM devoir WHERE idDevoir = ?";
					$parametre8 = array('1' => array($iddevoir, PDO::PARAM_INT));
					$statement8 = $BD->query($requete8,$parametre8);
				}	
			}
		}
		$requete9 = "DELETE FROM personne WHERE login = ?";
		$statement = $BD->query($requete9,$parametre);
	}
	
	public function SupprimerDevoir($idDevoir){
	
		$BD = BD::getInstance();
		$requete = "DELETE FROM avoirnote WHERE idDevoir = ?";
		$parametre = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement = $BD->query($requete, $parametre);
		
		$requete2 = "DELETE FROM devoir WHERE idDevoir = ?";
		$parametre2 = array('1' => array($idDevoir, PDO::PARAM_INT));
		$statement2 = $BD->query($requete2, $parametre2);
	}	
	
	public function GetNbDemandesInscription(){
	
		$BD = BD::getInstance();
		$requete = "SELECT COUNT(*) FROM personne WHERE role = 'demandeur'";
		$parametre = array();
		$statement = $BD->query($requete, $parametre);
		$resultat = $BD->getResult($statement);
		return $resultat[0];
	}
	
	public function GetDemandesInscriptions(){
	
		$BD = BD::getInstance();
		$requete = "SELECT login, nom, prenom, email, numTel, role FROM personne WHERE role = 'demandeur'";
		$parametre = array();
		$statement = $BD->query($requete, $parametre);
		return $BD->getResults($statement);
	}
	
	public function DeclinerDemandeInscription($login){
	
		$BD = BD::getInstance();
		$requete = "DELETE FROM personne WHERE login = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
	
	public function ValiderDemandeInscription($login){
	
		$BD = BD::getInstance();
		$requete = "UPDATE personne SET role = 'enseignant' WHERE login = ?";
		$parametre = array('1' => array($login, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
	
	public function SupprimerAvis($loginPersonne, $idFormation){
	
		$BD = BD::getInstance();
		$requete = "DELETE FROM avis WHERE loginPersonne = ? AND idFormation = ?";
		$parametre = array('1' => array($loginPersonne, PDO::PARAM_STR),
						   '2' => array($idFormation, PDO::PARAM_STR));
		$BD->query($requete, $parametre);
	}
}
?>