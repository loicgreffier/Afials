<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueAvisFormation".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueAvisFormationBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='avisFormations'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket8'); } </script>";  } ?>	
	<div id='blanket8' style='display:none'></div>
	<?php if(isset($formation)){ ?>
		<div id='ajouterAvis' style='display:none'>
			<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterAvis','blanket8')><img src='./Vue/Images/Icones/fermer.png'></img></a>
			<form id='formulaireAjoutAvis' method='post' action='./index.php'>
				<input type='hidden' name='action' value='AjouterAvis'/>
				<input type='hidden' name='idDiv' value='ajouterAvis'/>
				<input type='hidden' name='nomEnseignant' value='<?php echo $nomEnseignant ?>'/>
				<input type='hidden' name='prenomEnseignant' value='<?php echo $prenomEnseignant ?>'/>
				<input type='hidden' name='noteAvis' id='noteAvis' value=0/>
				<input type='hidden' name='idFormation' value="<?php echo $formation->getIdFormation() ?>"/>
				<table id='tableauAjoutAvis'>
					<tr><td class='titreAjoutAvis'><label>Avis</label></td></tr>			
					<?php if(isset($this->tableauErreurs))
							if(in_array('ajouterAvis',$this->tableauErreurs)){
								for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
									echo "<tr><td><label class='messageErreurAjoutAvis'>".$this->tableauErreurs[$i]."</label></td></tr>";	
							}
					?>
					<tr><td><label>Note</label></td></tr>
					<tr>
						<td class='champAvis'>
							<div class='ajouterEtoile'>
								<a href="#" id='etoileCinq' onclick=ajouterNote(5,'noteAvis','etoileUne','etoileDeux','etoileTrois','etoileQuatre','etoileCinq','yellow'); title="Donner 5 étoiles">☆</a>
								<a href="#" id='etoileQuatre' onclick=ajouterNote(4,'noteAvis','etoileUne','etoileDeux','etoileTrois','etoileQuatre','etoileCinq','yellow'); title="Donner 4 étoiles">☆</a>
								<a href="#" id='etoileTrois' onclick=ajouterNote(3,'noteAvis','etoileUne','etoileDeux','etoileTrois','etoileQuatre','etoileCinq','yellow'); title="Donner 3 étoiles">☆</a>
								<a href="#" id='etoileDeux' onclick=ajouterNote(2,'noteAvis','etoileUne','etoileDeux','etoileTrois','etoileQuatre','etoileCinq','yellow'); title="Donner 2 étoiles">☆</a>
								<a href="#" id='etoileUne' onclick=ajouterNote(1,'noteAvis','etoileUne','etoileDeux','etoileTrois','etoileQuatre','etoileCinq','yellow'); title="Donner 1 étoile">☆</a>
							</div>
						</td>
					</tr>
					<tr><td><label>Commentaire</label></td></tr>
					<tr><td><textarea maxlength='200' type='text' name='commentaireAvis'></textarea></td></tr>
					<tr><td id='ajouterAvisButton'><input type='submit' value='Ajouter'></input></td></tr>
				</table>
			</form>
		</div>
	<?php } ?>
	<section id='listeEnseignantsAvis'>
	<?php if(isset($listeEnseignants)){
			echo "<h1 id='titreListeEnseignantsAvis'> Liste des enseignants </h1>";
			echo "<table id='tableauEnseignantsAvis'>";
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
				echo "<div id='nbPagesEnseignantAvis'>";
				for ($i = 1; $i <= $nbPagesEnseignant; $i++) 
					echo "<a href='./index.php?action=ConsulterPageFormations&pageCourante=".$i."'>".$i."</a>";
			}
				echo "</div>";						
		}
	?>
	</section>
	<article id='presentationFormationsAvis'>	
	<?php	
		if(isset($formation)){
			echo "<table id='tableauFormationsAvis'>
					<tr>
						<td id='nomFormationAvis' colspan=2><span class='coloration'>".$formation->getNomFormation()."</span> proposée par <span class='coloration'>".$nomEnseignant."</span> <span class='coloration'>".$prenomEnseignant."</span></td>
					</tr>
					<tr>
						<td id='labelTypeFormationAvis'>Type de formation: </td>
						<td id='typeFormationAvis'>".$formation->getNomTypeFormation()."</td>
					</tr>
					<tr>
						<td id='descriptifAvis' colspan=3><p>".$formation->getDescriptif()."</p></td>
					</tr>
			</table>";
		
		if(isset($avis)){
			$i = 0;
			echo "<div id='listeAvisTitre'>
					<p id='listeAvis'> Liste des avis </p>
					<p class='ajouterAvis'><a onclick=\"gererAffichageProfondeur('ajouterAvis','blanket8');\" href='#'> Ajouter un avis </a></p>
				</div>";
			foreach($avis as $a){
				echo "<table class='tableauAvis'>
						<tr>
							<td id='avisDe'>Avis de: <span class='coloration'>".$a->getPersonne()->getNom()."</span> <span class='coloration'>".$a->getPersonne()->getPrenom()."</span></td>
							<td>
								<div class='evaluation'>
									<p class='titreEvalNote'> Note "; if(isset($roleEnseignant)){ echo "<a onclick=\"return confirm('Voulez-vous vraiment supprimer cet avis ?');\" href='./index.php?action=SupprimerAvis&loginPersonne=".$a->getPersonne()->getLogin()."&idFormation=".$a->getFormation()->getIdFormation()."&idFormation=".$formation->getIdFormation()."&nomEnseignant=".$nomEnseignant."&prenomEnseignant=".$prenomEnseignant."' title='supprimer cet avis'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; } 
									echo "</p>
									<p class='evalNote' id='etoileUne".$i."'>☆</p>
									<p class='evalNote' id='etoileDeux".$i."'>☆</p>
									<p class='evalNote' id='etoileTrois".$i."'>☆</p>
									<p class='evalNote' id='etoileQuatre".$i."'>☆</p>
									<p class='evalNote' id='etoileCinq".$i."'>☆</p>
								</div>
							</td>
						</tr>
						<tr>
							<td class='commentairePersonne'>".$a->getCommentaire()."</td>
						</tr>
					</table>
					<script> gestionEvaluationEtoile(".$a->getNote().",'etoileUne".$i."','etoileDeux".$i."','etoileTrois".$i."','etoileQuatre".$i."','etoileCinq".$i."','".$couleur."'); </script>";
			$i++;
			}
		} else { 
			echo "<div id='divNoAvis'>";
				echo "<h1 id='noAvis'> Aucun avis sur cette formation </h1>";
				echo "<p class='ajouterAvis'><a onclick=\"gererAffichageProfondeur('ajouterAvis','blanket8');\" href='#'> Ajouter un avis </a></p>";
			echo "</div>";
		}
	}
	?>
	</article>
</article>
				
<?php require_once('./Vue/Footer.php'); ?>