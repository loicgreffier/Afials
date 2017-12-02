<?php 
Autoloader::getInstance()->autoload(array('DALEtudiant','Formation','Avis','Personne','Note','Devoir','Personne'));

class ModeleEtudiant{

	public function __construct(){}
	
	public function isEtudiant(){
		
		if(isset($_SESSION['role']) && $_SESSION['role'] == "etudiant")
			return true;
	}
	
	public function AjouterSujet($idForum, $titreSujet, $messageSujet, $login){
	
		$DALEtudiant = new DALEtudiant();
		$DALEtudiant->AjouterSujet($idForum, $titreSujet, $messageSujet, $login);
	}
	
	public function AjouterMessage($message, $idSujet, $login){
	
		$DALEtudiant = new DALEtudiant();
		$DALEtudiant->AjouterMessage($message, $idSujet, $login);
	}
	
	public function GetFormationById($idFormation){
	
		$DALEtudiant = new DALEtudiant();
		$formation = $DALEtudiant->GetFormationById($idFormation);
		return new Formation($formation[0][0],$formation[0][1],$formation[0][2],$formation[0][3]);
	}
	
	public function GetAvisFormationById($idFormation){
	
		$DALEtudiant = new DALEtudiant();
		$avis = $DALEtudiant->GetAvisFormationById($idFormation);
		if(!empty($avis)){
			foreach($avis as $a){
				$tAvis[] = new Avis(new Personne($a[0],$a[1],$a[2],$a[3],$a[4],$a[5]), new Formation($a[8],$a[9],$a[10],$a[11]), $a[6], $a[7]);
			}
			return $tAvis;
		}
	}
	
	public function AjouterAvis($note, $commentaire, $idformation, $login){
	
		$DALEtudiant = new DALEtudiant();
		$DALEtudiant->AjouterAvis($note, $commentaire, $idformation, $login);
	}

	public function CountNbFormationsEvalueesEleve($loginEleve){
	
		$DALEtudiant = new DALEtudiant();
		return $DALEtudiant->CountNbFormationsEvalueesEleve($loginEleve);
	}
	
	public function GetMesFormationsEvaluees($loginEleve,$pageCourante){
	
		$DALEtudiant = new DALEtudiant();
		$listeFormation = $DALEtudiant->GetMesFormationsEvaluees($loginEleve,$pageCourante);
		foreach($listeFormation as $formation)
			$tFormations[] = new Formation($formation[0],$formation[1],$formation[2],$formation[3]);
		return $tFormations;
	}
	
	public function CountDevoirsParFormationEleve($idFormation,$loginEleve){
	
		$DALEtudiant = new DALEtudiant();
		return $DALEtudiant->CountDevoirsParFormationEleve($idFormation,$loginEleve);
	}
	
	public function GetDevoirsParFormationEleve($idFormation, $loginEleve){
	
		$DALEtudiant = new DALEtudiant();
		$listeDevoirsEleves = $DALEtudiant->GetDevoirsParFormationEleve($idFormation, $loginEleve);
		foreach($listeDevoirsEleves as $devoir)
			$tDevoirs[] = new Devoir($devoir[0],$devoir[1],$devoir[2],$devoir[3],$devoir[4],$devoir[5],$devoir[6]);
		return $tDevoirs;
	}
	
	public function GetNoteDuDevoir($idDevoir, $loginEleve){
	
		$DALEtudiant = new DALEtudiant();
		$note = $DALEtudiant->GetNoteDuDevoir($idDevoir, $loginEleve);
		return new Note($note[0],$note[1],$note[2],$note[3]);
	}
	
	public function GetInformationsPersonne($login){
	
		$DALEtudiant = new DALEtudiant();
		$informationsPersonne = $DALEtudiant->GetInformationsPersonne($login);
		return new Personne($informationsPersonne[0], $informationsPersonne[1], $informationsPersonne[2], $informationsPersonne[3], $informationsPersonne[4], $informationsPersonne[5]);
	}
	
	public function ModifierMdp($login, $mdp){
	
		$DALEtudiant = new DALEtudiant();
		$DALEtudiant->ModifierMdp($login, $mdp);
	}
	
	public function ModifierInformations($login, $nom, $prenom, $email, $tel){
	
		$DALEtudiant = new DALEtudiant();
		$DALEtudiant->ModifierInformations($login, $nom, $prenom, $email, $tel);
	}
}
?>