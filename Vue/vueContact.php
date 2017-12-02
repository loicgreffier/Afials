<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueContact".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueContactBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='contact'>

<h1 class='titreContact'> Propriétaire </h1>
<table class='tableauInfos'>
	<tr>
		<td class='nomEtudiant'> Harketti Bendaoud </td>
	</tr>
	<tr>
		<td> <span class='nomEtudiant'>Email</span>: email@etu.udamail.fr </td>
	</tr>
	<tr>
		<td> <span class='nomEtudiant'>Telephone</span>: 06.10.10.10.10 </td>
	</tr>
</table>

<h1 class='titreContact'> Développeurs du site </h1>
<table class='tableauInfos'>
	<tr>
		<td class='nomEtudiant'> Greffier Loïc </td>
	</tr>
	<tr>
		<td>étudiant en deuxième année au département informatique de l'IUT de Clermont-Ferrand </td>
	</tr>
</table>

<table class='tableauInfos'>
	<tr>
		<td class='nomEtudiant'> Guillaume Vignon </td>
	</tr>
	<tr>
		<td> étudiant en deuxième année au département informatique de l'IUT de Clermont-Ferrand </td>
	</tr>
</table>

<table class='tableauInfos'>
	<tr>
		<td class='nomEtudiant'> Mallory Chevalier </td>
	</tr>
	<tr>
		<td> étudiant en deuxième année au département informatique de l'IUT de Clermont-Ferrand </td>
	</tr>

</table>

</article>
<?php require_once('./Vue/Footer.php'); ?>