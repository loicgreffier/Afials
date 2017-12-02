<?php 
Autoloader::getInstance()->autoload(array('DALVisiteur','Forum','Sujet','Message'));

class ModeleVisiteur{

	public function __construct(){}
	
	public function GetListeForums(){
	
		$DALVisiteur = new DALVisiteur();
		$forums = $DALVisiteur->GetListeForums();
		if(!empty($forums)){      
			foreach ($forums as $forum){
				$tForums[] = new Forum($forum[0],$forum[1]);			
			}	
			return $tForums;
		}
	}
	
	public function GetNbSujets($idForum){
		
		$DALVisiteur = new DALVisiteur();
		return $DALVisiteur->GetNbSujets($idForum);
	}
	
	public function GetListeSujets($idForum,$pageCourante){
	
		$DALVisiteur = new DALVisiteur();
		$sujets = $DALVisiteur->GetListeSujets($idForum,$pageCourante);
		
		foreach ($sujets as $sujet)
			$tSujets[] = new Sujet($sujet[0],$sujet[1],$sujet[2],$sujet[3],$sujet[4],$sujet[5]);				
		return $tSujets;
	}

	public function GetListeMessages($idSujet){
		
		$DALVisiteur = new DALVisiteur();
		$messages = $DALVisiteur->GetListeMessages($idSujet);
		if(!empty($messages)){
			foreach($messages as $message)
				$tMessages[] = new Message($message[0],$message[1],$message[2],$message[3],$message[4],$message[5]);
			return $tMessages;
		}
	}
	
	public function AjouterDemandeur($nom, $prenom, $email, $tel, $pseudo, $password){
	
		$DALVisiteur = new DALVisiteur();
		$DALVisiteur->AjouterDemandeur($nom, $prenom, $email, $tel, $pseudo, $password);
	}
}
?>