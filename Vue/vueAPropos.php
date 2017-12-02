<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueAPropos".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueAProposBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='apropos'>
<h2 id='titreAPropos'>Sur Afials.fr, il vous sera possible, selon votre profil, de :</h2>
<ul id='listeDroits'>
	<li> Consulter les formations proposés par les enseignants inscrit sur le site </li>
	<li> Donner votre avis sur les formations proposées </li>
	<li> Gérer les centres de formations dans lesquels vous intervenez </li>
	<li> Gérer les différentes formations que vous proposez </li>
	<li> Gérer les elèves dont vous êtes reponsables dans chacun de vos centres de formation </li>
	<li> Gérer vos interventions dans vos centres grâce à l'Agenda inclu </li>
	<li> Poser vos questions en surfant sur le forum intégré au site </li>
</ul>
</article>
<?php require_once('./Vue/Footer.php'); ?>