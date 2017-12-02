<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Formations', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueFormations".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Formations', 'utf-8', "./Vue/Css/SiteBleu/cssVueFormationsBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='formations'>
	<section id='listeEnseignants'>
	<?php if(isset($listeEnseignants)){
			echo "<h1 id='titreListeEnseignants'> Liste des enseignants </h1>";
			echo "<table id='tableauEnseignants'>";
				foreach($listeEnseignants as $enseignant){
					echo "<tr>
							<td>
								<a href='./index.php?action=ConsulterPageFormations&loginEnseignant=".$enseignant->getLogin()."&nomEnseignant=".urlencode($enseignant->getNom())."&prenomEnseignant=".urlencode($enseignant->getPrenom())."'>".$enseignant->getNom()." ".$enseignant->getPrenom()."</a>
							</td>
						</tr>";
				}
			echo "</table>";
			$nbPagesEnseignant = ceil($nbEnseignant/30);
			if($nbPagesEnseignant > 1){
				echo "<div id='nbPagesEnseignant'>";
				for ($i = 1; $i <= $nbPagesEnseignant; $i++) 
					echo "<a id='numeroPageEnseignant' href='./index.php?action=ConsulterPageFormations&pageCourante=".$i."'>".$i."</a>";
			}
				echo "</div>";						
		}
	?>
	</section>
						
	<article id='presentationFormations'>	
	<?php		
		echo "<div id='parametresFormation'>
				<input title='imprimer cette page' id='imprimer' type='image' onclick='window.print()' src='./Vue/Images/Icones/imprimer.png'></input>
				<h1 id='nomEnseignant'>Formations de ".$prenomEnseignant." ".$nomEnseignant."</h1>
			</div>	
			<div id='tableauxDesFormations'>";
			if(isset($formationsEnseignant)){
				foreach($formationsEnseignant as $formation){
					echo "<table class='tableauFormations'>
							<tr>
								<td class='consulteravis' colspan=2><a href='./index.php?action=ConsulterAvis&idFormation=".$formation->getIdFormation()."&nomEnseignant=".$nomEnseignant."&prenomEnseignant=".$prenomEnseignant."'>Voir les avis</a></td>
							</tr>
							<tr>
								<td class='nomFormation' colspan=2>".$formation->getNomFormation()."</td>
							</tr>
							<tr>
								<td class='labelTypeFormation'>Type de formation: </td>
								<td class='typeFormation'>".$formation->getNomTypeFormation()."</td>
							</tr>
							<tr>
								<td class='descriptif' colspan=3><p>".$formation->getDescriptif()."</p></td>
							</tr>
					</table>";
				}
			echo "</div>";
			$nbPagesFormations = ceil($nbFormationEnseignant/5);
			if($nbPagesFormations > 1){
				echo "<div class='nbPagesFormation'>";
				for ($i = 1; $i <= $nbPagesFormations; $i++) 
					echo "<a href='./index.php?action=ConsulterPageFormations&loginEnseignant=".$loginEnseignant."&pageCouranteFormation=".$i."'>".$i."</a>";	
				echo "</div>";	
			}
		} else { echo "<h1 id='noFormationsEnseignant'>Cet enseignant ne possède pas de formations</h1>"; }
	?>
	</article>
</article>
<?php require_once('./Vue/Footer.php'); ?>