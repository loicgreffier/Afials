<?php

class Note{

	private $idNote;
	private $note;
	private $loginPersonne;
	private $idFormation;
	
	public function getIdNote(){
		return $this->idNote;
	}
	
	public function setIdNote($idnote){
		$this->idNote = $idnote;
	}
	
	public function getNote(){
		return $this->note;
	}
	
	public function setNote($note){
		$this->note = $note;
	}
	
	public function setLoginPersonne($login){
		$this->loginPersonne = $login;
	}
	
	public function getLoginPersonne(){
		return $this->loginPersonne;
	}
	
	public function getIdFormation(){
		return $this->idFormation;
	}
	
	public function setIdFormation($id){
		$this->idFormation = $id;
	}
	
	public function __construct($idNote, $note, $idFormation, $login){
		$this->setIdNote($idNote);
		$this->setNote($note);
		$this->setIdFormation($idFormation);
		$this->setLoginPersonne($login);
	}
}
?>