<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssFooter".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssFooterBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<footer> 
	<?php 
			if(isset($_COOKIE['couleurSite'])){ 
				if($_COOKIE['couleurSite'] == "Rouge"){ AfficherPadsFooter('#3A0000','#5D0000','#890000','#980000','#B00000','#D20000','#FF0000','#FF2F2F','#FF5555','#FFA0A0');
				} else if($_COOKIE['couleurSite'] == "Bleu"){ AfficherPadsFooter('#00001D','#00003A','#00005D','#0000A6','#0000FF','#3838FF','#5555FF','#8484FF','#BCBCFF','#E2E2FF');
				} else if($_COOKIE['couleurSite'] == "Vert"){ AfficherPadsFooter('#004400','#005D00','#006B00','#007A00','#008400','#00A600','#00DC00','#09FF09','#71FF71','#97FF97');}
			} else { AfficherPadsFooter('#00001D','#00003A','#00005D','#0000A6','#0000FF','#3838FF','#5555FF','#8484FF','#BCBCFF','#E2E2FF'); }
		?>
	<p id='developperpar'>Développé par Guillaume Vignon, Mallory Chevalier, Loic Greffier</p>
</footer>