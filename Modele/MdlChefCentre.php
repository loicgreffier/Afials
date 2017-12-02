<?php 
Autoloader::getInstance()->autoload(array('DALChefCentre','CentreFormation','DALEnseignant'));

class ModeleChefCentre{

	public function __construct(){}
	
	public function isChefCentre(){
		
		if(isset($_SESSION['role']) && $_SESSION['role'] == "chefcentre")
			return true;
	}
	
	public function GetNbCentresFormationChefCentre($login){
	
		$DALChefCentre = new DALChefCentre();
		return $DALChefCentre->GetNbCentresFormationChefCentre($login);
	}
	
	public function GetCentresFormationChefCentre($login,$pageCourante){
		
		$DALChefCentre = new DALChefCentre();
		if(empty($pageCourante))
			$centresformation = $DALChefCentre->GetCentresFormationChefCentre($login);
		if(!empty($pageCourante))
			$centresformation = $DALChefCentre->GetCentresFormationChefCentre($login,$pageCourante);
			
		if(!empty($centresformation)){
			foreach($centresformation as $centreformation)
				$tCentres[] = new CentreFormation($centreformation[0],$centreformation[1],$centreformation[2],$centreformation[3],$centreformation[4],$centreformation[5]);
			return $tCentres;
		}
	}
	
	public function GetNbGroupes($idCentre){
	
		$DALChefCentre = new DALChefCentre();
		return $DALChefCentre->GetNbGroupes($idCentre);
	}
	
	public function SupprimerGroupeCC($idGroupe){
	
		$DALChefCentre = new DALChefCentre();
		$loginsEleve = $DALChefCentre->SupprimerGroupeCC($idGroupe);
		if(!empty($loginsEleve)){
			$DALEnseignant = new DALEnseignant();
			foreach($loginsEleve as $login)
				$DALEnseignant->SupprimerEleve($login);
		}
	}
}
?>