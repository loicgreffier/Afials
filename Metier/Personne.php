<?php

class Personne{

	private $login;
	private $nom;
	private $prenom;
	private $email;
	private $tel;
	private $role;
	
	public function getLogin(){
		return $this->login;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
	public function setNom($nom){
		$this->nom = $nom;
	}
	public function getPrenom(){
		return $this->prenom;
	}
	
	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	public function getRole(){
		return $this->role;
	}
	
	public function setRole($role){
		$this->role = $role;
	}
	
	public function getTel(){
		return $this->tel;
	}

	public function setTel($tel){
		$this->tel = $tel;
	}
	
	public function __construct($login, $nom, $prenom, $email, $numTel, $role){
		$this->setLogin($login);
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setEmail($email);
		$this->setTel($numTel);
		$this->setRole($role);
	}
}
?>