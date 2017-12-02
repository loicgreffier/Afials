<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueMentionsLegales".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueMentionsLegalesBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='mentionslegales'>
<h1 id='titreMentionsLegales'> Mentions légales </h1>
<h2 class='soustitreMentionsLegales'> Droits et copyrights </h2>
<p id='textCopy'> <span style="margin-left:50px">L'</span>ensemble des illustrations, photographies, plans, dessins, animations, vidéos, sons ou textes figurant sur ce site web ne peuvent être utilisés sans obtenir au préalable l'autorisation 
des developpeurs du site web eux-mêmes.</p>

<h2 class='soustitreMentionsLegales'> Hébergeur du site web </h2>
	<table id='tableauOvh'>
		<tr>
			<td class='titreMentions'> Hébergeur </td>
			<td class='texteMentions'><a href='https://www.ovh.com/fr/index.xml'>www.ovh.com</a></td>
		</tr>
		<tr>
			<td class='titreMentions'> Siège social </td>
			<td class='texteMentions'> 2 rue Kellermann - 59100 Roubaix - France. </td>
		</tr>
		<tr>
			<td class='titreMentions'> Directeur </td>
			<td class='texteMentions'> Octave KLABA </td>
		</tr>
		<tr>
			<td class='titreMentions'> Numéro de téléphone commercial </td>
			<td class='texteMentions'> 0 820 698 765 (n° indigo (0,118 €/min)) </td>
		</tr>
		<tr>
			<td class='titreMentions'> Numéro de téléphone technique </td>
			<td class='texteMentions'> 0 899 498 765 (1,349€/appel + 0,337 €/min) </td>
		</tr>
	</table>
</article>
<?php require_once('./Vue/Footer.php'); ?>