<?php
	ini_set('display_errors','on');
	require('./Config/Autoloader.php');
	Autoloader::getInstance()->Autoload(array('FrontCtrl', 'FunctionHTML')); 
	if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Afials.fr', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueAccueil".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Afials.fr', 'utf-8', "./Vue/Css/SiteBleu/cssVueAccueilBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }
	$FrontCtrl = new FrontControleur();	
	FinFichierHTML(); 
?>