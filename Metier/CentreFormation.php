<?php 

class CentreFormation{
	
	private $idCentre;
	private $nomCentre; 
	private $nomVille;
	private $nomRue;
	private $codePostal;
	private $loginChefGroupe;
	
	/* id Centre */
	public function getIdCentre(){
		return $this->id;
	}

	public function setIdCentre($id){
		$this->id = $id;
	}
		
	/* nom Centre */
		public function getNomCentre(){
		return $this->nomCentre;
	}

	public function setNomCentre($nomCentre){
		$this->nomCentre = $nomCentre;
	}
	
	/* nom Ville */
	public function getNomVille(){
		return $this->nomVille;
	}
	
	public function setNomVille($nomVille){
		$this->nomVille = $nomVille;
	}
	
	/* nom Rue */
	
	public function getNomRue(){
		return $this->nomRue;
	}
	
	public function setNomRue($nomRue){
		$this->nomRue = $nomRue;
	}
	
	/* code postal */
	
	public function getCodePostal(){
		return $this->codePostal;
	}
	
	public function setCodePostal($codePostal){
		$this->codePostal = $codePostal;
	}
		
	public function getLoginCC(){
		return $this->loginChefCentre;
	}
	
	public function setLoginCC($login){
		$this->loginChefCentre = $login;
	}
	/* Constructeur */
	
	public function __construct($idCentre, $nomCentre, $nomRue, $nomVille, $codePostal, $login){
		$this->setIdCentre($idCentre);
		$this->setNomCentre($nomCentre);
		$this->setNomVille($nomVille);
		$this->setNomRue($nomRue);
		$this->setCodePostal($codePostal);
		$this->setLoginCC($login);
	}
}
?>