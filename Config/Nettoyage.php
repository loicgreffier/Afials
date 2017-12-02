<?php 

class Nettoyage{

	public static function CreerNumeroTelephone($tel){
		return substr(chunk_split($tel, 2, '-'), 0, -1); 
	}
}
?>