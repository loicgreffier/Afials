<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssHeader".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssHeaderBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<div id='enteteSite'>
	<header>
		<?php 
			if(isset($_COOKIE['couleurSite'])){ 
				if($_COOKIE['couleurSite'] == "Rouge"){ AfficherPadsEntete('#3A0000','#5D0000','#890000','#980000','#B00000','#D20000','#FF0000','#FF2F2F','#FF5555','#FFA0A0');
				} else if($_COOKIE['couleurSite'] == "Bleu"){ AfficherPadsEntete('#00001D','#00003A','#00005D','#0000A6','#0000FF','#3838FF','#5555FF','#8484FF','#BCBCFF','#E2E2FF');
				} else if($_COOKIE['couleurSite'] == "Vert"){ AfficherPadsEntete('#004400','#005D00','#006B00','#007A00','#008400','#00A600','#00DC00','#09FF09','#71FF71','#97FF97'); }
			} else { AfficherPadsEntete('#00001D','#00003A','#00005D','#0000A6','#0000FF','#3838FF','#5555FF','#8484FF','#BCBCFF','#E2E2FF'); }
		?>
		<div class='titre'>
			<a href='./index.php'>AFIALS</a>
			<p> Gestion des formations </p>
		</div>
	</header>
	<nav class='barreNavigation'>
		<ul class='navigation'>
			<li class='bouttonNav'><a href='./index.php'>Accueil</a></li>
			<li class='bouttonNav'><a href='./index.php?action=ConsulterPageFormations'>Formations</a></li>
			<li class='bouttonNav'><a href='./index.php'>Gestion</a>
				<?php if(!isset($roleEtudiant)){ ?>
					<ul>
						<li class='bouttonGestion'><a href='./index.php?action=ConsulterMesCentresFormation'>Mes centres de formations</a></li>
						<li class='bouttonGestion'><a href='./index.php?action=ConsulterMesFormations'>Mes formations</a></li>
						<?php echo "<li class='bouttonGestion'><a href='./index.php?action=".$actionConsulterEleves."'>Mes élèves</a></li>"; ?>
						<li class='bouttonGestion'><a href='./index.php?action=ConsulterAgenda'>Mon agenda</a></li>
						<?php if(isset($loginSuperEnseignant)){ 
								if(isset($nouvellesDemandes)){
									echo "<li class='bouttonGestion'><a href='./index.php?action=ConsulterDemandesInscription'>Demandes d'inscription<img title=\"Vous avez de nouvelles demandes d'inscription\" style='margin-left: 10px;' src='./Vue/Images/Icones/exclamation.png'></img></a></li>"; 
								} else { echo "<li class='bouttonGestion'><a href='./index.php?action=ConsulterDemandesInscription'>Demandes d'inscription</a></li>"; }
							}
						?>
					</ul>
				<?php } else if(isset($roleEtudiant)) { ?>
					<ul> 
						<li class='bouttonGestion'><a href='./index.php?action=ConsulterMesNotes'>Mes notes</a></li>
					</ul>
				<?php } ?>
			</li>
			
			<li class='bouttonNav'><a href='./index.php?action=ConsulterPageForum'>Forum</a>
	<?php 	if(isset($listeForums)){
				echo "<ul>";
				foreach($listeForums as $forum){	
					echo "<div class='forums'>
							<li class='nomForums'><a href='./index.php?action=ConsulterForum&idForum=".$forum->getIdForum()."&nomForum=".urlencode($forum->getIntitule())."'>".$forum->getIntitule()."</a></li>";
					echo "</div>"; 
					}
				echo "</ul>";
			} 
	?>
			</li>
	<?php 	if(isset($loginPersonneConnectee)){ 
				echo "<li id='bouttonDeconnexion' class='bouttonNav'><a href='./index.php?action=SeDeconnecter'>Déconnexion</a></li>";
			} else { echo "<li id='bouttonConnexion' class='bouttonNav'><a href='./index.php?action=AfficherVueConnexion'>Connexion</a></li>"; }	
	?>
			<li id='bouttonMonCompte' class='bouttonNav'><a href='./index.php?action=GererMonCompte'>Mon compte</a>
		</ul>
	</nav>
</div>
