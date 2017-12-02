<?php

function DebutFichierHTML($title, $charset, $css, $icone){
	echo "<!DOCTYPE html>";
	echo "<html lang=\"fr\">";
	echo "<head>";
		echo "<meta charset=\"" . $charset . "\"/>";
		echo "<link rel=\"stylesheet\" href=\"./" . $css . "\"/>";
		echo "<link rel=\"icon\" href=\"./" . $icone . "\"type=\"image/x-icon\"/>";
		echo "<link rel=\"shortcut icon\" href=\"./" . $icone . "\"type=\"image/x-icon\"/>";
		echo "<title>" . $title . "</title>";
		echo "<script type='text/javascript' src='./Scripts/popupAjoutSujet.js'></script>";
	echo "</head>";
	echo "<body>";
}
?>

<?php function FinFichierHTML(){echo "</body></html>";} ?>

<?php
function AfficherPadsEntete($couleur1,$couleur2,$couleur3,$couleur4,$couleur5,$couleur6,$couleur7,$couleur8,$couleur9,$couleur10){

	echo "<div class='padsGauche'>
		<div class='haut' style='background:".$couleur1."'></div>
		<div class='bas' style='background:".$couleur2."'></div>
		<div class='haut' style='background:".$couleur3."'></div>
		<div class='bas' style='background:".$couleur4."'></div>
		<div class='haut' style='background:".$couleur5."'></div>
		<div class='bas' style='background:".$couleur6."'></div>
		<div class='haut' style='background:".$couleur7."'></div>
		<div class='bas' style='background:".$couleur8."'></div>
		<div class='haut' style='background:".$couleur9."'></div>
		<div class='haut' style='background:".$couleur10."'></div>
	</div>
	<div class='padsDroite'>
		<div class='haut' style='background:".$couleur1."'></div>
		<div class='bas' style='background:".$couleur2."'></div>
		<div class='haut' style='background:".$couleur3."'></div>
		<div class='bas' style='background:".$couleur4."'></div>
		<div class='haut' style='background:".$couleur5."'></div>
		<div class='bas' style='background:".$couleur6."'></div>
		<div class='haut' style='background:".$couleur7."'></div>
		<div class='bas' style='background:".$couleur8."'></div>
		<div class='haut' style='background:".$couleur9."'></div>
		<div class='haut' style='background:".$couleur10."'></div>
	</div>";
}
?>

<?php
function AfficherPadsFooter($couleur1,$couleur2,$couleur3,$couleur4,$couleur5,$couleur6,$couleur7,$couleur8,$couleur9,$couleur10){

	echo "<div class='padsGaucheF'>
		<div class='haut' style='background:".$couleur1."'></div>
		<div class='bas' style='background:".$couleur2."'></div>
		<div class='haut' style='background:".$couleur3."'></div>
		<div class='bas' style='background:".$couleur4."'></div>
		<div class='haut' style='background:".$couleur5."'></div>
		<div class='bas' style='background:".$couleur6."'></div>
		<div class='haut' style='background:".$couleur7."'></div>
		<div class='bas' style='background:".$couleur8."'></div>
		<div class='haut' style='background:".$couleur9."'></div>
		<div class='haut' style='background:".$couleur10."'></div>
	</div>
	<div class='padsDroiteF'>
		<div class='haut' style='background:".$couleur1."'></div>
		<div class='bas' style='background:".$couleur2."'></div>
		<div class='haut' style='background:".$couleur3."'></div>
		<div class='bas' style='background:".$couleur4."'></div>
		<div class='haut' style='background:".$couleur5."'></div>
		<div class='bas' style='background:".$couleur6."'></div>
		<div class='haut' style='background:".$couleur7."'></div>
		<div class='basF' id='uda'></div>
		<a href='https://www.facebook.com/pages/Afials/930215026991694'><div class='hautF' id='facebook'></div></a>
		<a href='#' id='atwitter'><div class='hautF' id='twitter'></div></a>
	</div>";
}
?>	
	
		
