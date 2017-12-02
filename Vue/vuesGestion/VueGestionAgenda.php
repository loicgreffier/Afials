<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionAgenda".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionAgendaBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='monAgenda'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket3'); } </script>";  } ?>	
	<div id='blanket3' style='display:none'></div>
	<div id='ajouterIntervention' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterIntervention','blanket3')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutIntervention' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterIntervention'>
			<input type='hidden' name='loginEnseignant' value='<?php echo $loginPersonneConnectee ?>'>
			<input type='hidden' name='idDiv' value='ajouterIntervention'/>
			<table id='tableauAjoutIntervention'>
				<tr><td colspan=2 id='titreAjoutIntervention'><label>Ajouter une nouvelle intervention</label></td></tr>
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterIntervention',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>		
				<tr>
					<td><label>Choisissez le centre</label></td>
					<td><label>Choisissez la formation</label></td>
				</tr>
				<tr>
					<td>
						<select name='idCentre'>
							<option value="">Selectionnez un centre </option>
							<?php if(isset($centresFormation)){
									foreach($centresFormation as $centre)
										echo "<option value=".$centre->getIdCentre().">".$centre->getNomCentre()." - ".$centre->getNomVille()."</option>"; 
								} 
							?>
						</select>
					</td>
					<td>
						<select name='idFormation'>
							<option value="">Selectionnez une formation </option>
							<?php if(isset($formations)){
									foreach($formations as $formation)
										echo "<option value=".$formation->getIdFormation().">".$formation->getNomFormation()."</option>"; 
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class='label'><label>Date de début</label></td>
					<td class='label'><label>Heure de début</label></td>
				</tr>
				<tr>
					<td>
						<select name='jourDebut'>
							<?php for ($jour = 1 ; $jour <= 31 ; $jour++)
									echo "<option value=".$jour.">".str_pad($jour, 2, "0", STR_PAD_LEFT)."</option>"; 
						?>
						</select>
						<select name='moisDebut'>
							<?php for ($mois = 1 ; $mois <= 12 ; $mois++)
									echo "<option value=".$mois.">".str_pad($mois, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='anneeDebut'>
							<?php for ($annee = date('Y') ; $annee <= date('Y')+5 ; $annee++)
									echo "<option value=".$annee.">".$annee."</option>";
							?>
						</select>
					</td>
					<td>
						<select name='heureDebut'>
							<?php for ($heure = 7 ; $heure <= 22 ; $heure++)
									echo "<option value=".$heure.">".str_pad($heure, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='minuteDebut'>
							<?php for ($minute = 0 ; $minute < 60 ; $minute = $minute+5)
									echo "<option value=".$minute.">".str_pad($minute, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class='label'><label>Date de fin</label></td>
					<td class='label'><label>Heure de fin</label></td>
				</tr>
				<tr>
					<td>
						<select name='jourFin'>
							<?php for ($jour = 1 ; $jour <= 31 ; $jour++)
									echo "<option value=".$jour.">".str_pad($jour, 2, "0", STR_PAD_LEFT)."</option>"; 
						?>
						</select>
						<select name='moisFin'>
							<?php for ($mois = 1 ; $mois <= 12 ; $mois++)
									echo "<option value=".$mois.">".str_pad($mois, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='anneeFin'>
							<?php for ($annee = date('Y') ; $annee <= date('Y')+5 ; $annee++)
									echo "<option value=".$annee.">".$annee."</option>";
							?>
						</select>
					</td>
					<td>
						<select name='heureFin'>
							<?php for ($heure = 7 ; $heure <= 22 ; $heure++)
									echo "<option value=".$heure.">".str_pad($heure, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='minuteFin'>
							<?php for ($minute = 0 ; $minute < 60 ; $minute = $minute+5)
									echo "<option value=".$minute.">".str_pad($minute, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
					</td>
				</tr>
				<tr><td colspan=2 class='label'><label>Nombre de répétitions</label></td></tr>
				<tr>
					<td colspan=2>
						<select name='nbRepetitions'>
							<option value=1>1 semaine</option>
							<?php for ($repetition = 2 ; $repetition <= 52 ; $repetition++)
									echo "<option value=".$repetition.">".$repetition." semaines</option>"; 
						?>
						</select>
					</td>
				</tr>
				<tr><td colspan=2 class='label'><label>Salle (facultatif)</label></td></tr>
				<tr><td colspan=2 ><input type='text' name='salle'></input>
				<tr><td colspan=2 id='champAjoutIntervention'><input id='bouttonAjouterIntervention' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
			
	<div id='parametresAgenda'>
		<ul>	
			<li id='titreMonAgenda'> Gestion de l'emploi du temps </li>
			<li><a onclick=gererAffichageProfondeur('ajouterIntervention','blanket3') id='BouttonAjouterIntervention' title='Ajouter une intervention' href='#'>Nouvelle Intervention</a></li>
			<li><a onclick="return confirm('Voulez-vous vider l\'agenda ? Toutes les données seront effacées et irrécupérables');" id='BouttonViderAgenda' title='Vider votre agenda' href='./index.php?action=ViderAgenda'>Vider l'agenda</a></li>
		</ul>
	</div>
	<?php 
	 if(isset($interventions)){	
			echo "<table id='tableauAgenda'>
					<tr>
						<td class='enteteIntervention'>Début</td>
						<td class='enteteIntervention'>Fin</td>						
						<td class='enteteIntervention'>Formation</td>						
						<td class='enteteIntervention'>Centre</td>					
						<td class='enteteIntervention'>Ville</td>					
						<td class='enteteIntervention'>Salle</td>				
					</tr>";
			$i = 0;
			foreach($interventions as $intervention){
				echo "<tr>
						<td id='dateDebut".$i."' class='variableIntervention'>".date("l d-M-Y à H\hi", strtotime($intervention->getDateDebut()))."</td>
						<td id='dateFin".$i."' class='variableIntervention'>".date("l d-M-Y H\hi", strtotime($intervention->getDateFin()))."</td>
						<td id='nomFormation".$i."' class='variableIntervention'>".$intervention->getNomFormation()."</td>
						<td id='nomCentre".$i."' class='variableIntervention'>".$intervention->getNomCentre()."</td>
						<td id='villeCentre".$i."' class='variableIntervention'>".$intervention->getVilleCentre()."</td>
						<td id='salle".$i."' class='variableIntervention'>".$intervention->getSalle()."</td>
						<td class='supprimerForum'>
							<a onclick=\"return window.confirm('Voulez-vous supprimer cette intervention ?');\" title='supprimer cette intervention' href='./index.php?action=SupprimerIntervention&idIntervention=".$intervention->getIdIntervention()."'>
								<img class='supprimerIntervention' src='./Vue/Images/Icones/supprimer.png'></img>
							</a>
						</td>	
				</tr>";
				if($intervention->getDateFin() < date('Y-m-d H:i:s'))
					echo "<script> changerCouleurAgenda('dateDebut".$i."','dateFin".$i."','nomFormation".$i."','nomCentre".$i."','villeCentre".$i."','salle".$i."'); </script>"; 
				$i++;
			}
			echo "</table>";
			
			$nbPagesInterventions = ceil($nbInterventionsEnseignant/25);
			if($nbPagesInterventions > 1){
				echo "<div class='nbPagesInterventions'>";
				for ($i = 1; $i <= $nbPagesInterventions; $i++)
					echo "<a href='./index.php?action=ConsulterAgenda&loginEnseignant=".$loginEnseignantConnecte."&pageCouranteIntervention=".$i."'>".$i."</a>";	
				echo "</div>";
			}
		} else { echo "<h1 id='NoInterventions'>Vous n'avez aucune intervention</h1>"; }
	?>
</article>
<?php require_once('./Vue/Footer.php'); ?>			