<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionNotes".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionNotesBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='notesEleves'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket6'); } </script>";  } ?>	
	<div id='blanket6' style='display:none'></div>
	<div id='ajouterNotes' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterNotes','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutNotes' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterNotes'></input>
			<input type='hidden' name='idDiv' value='ajouterNotes'></input>
			<input type='hidden' name='nombreEleve' value='<?php echo count($listeEleves); ?>'></input>
			<input type='hidden' name='idGroupe' value='<?php echo $idGroupeActuel ?>'></input>			
			<input type='hidden' name='nomGroupe' value='<?php echo $nomGroupeActuel ?>'></input>			
			<input type='hidden' name='idCentre' value='<?php echo $idCentreDuGroupeActuel ?>'></input>			
			<input type='hidden' name='nomCentre' value='<?php echo $nomCentreDuGroupeActuel ?>'></input>			
			<table id='tableauAjoutNotes'>
				<tr><td class='titreAjoutNotes'><label>Ajouter des notes</label></td></tr>			
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterNotes',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td class='labelAjoutNote'><label>Selectionner la formation</label></td></tr>
				<tr><td><select name='idFormation'>
						<option value="">Selectionner la formation à évaluer </option>
				<?php if(isset($mesFormations)){
						foreach($mesFormations as $formation) 
							echo "<option value=".$formation->getIdFormation().">".$formation->getNomFormation()."</option>"; 
					} 
				?>
				</select></td></tr>
				<tr><td class='labelAjoutNote'><label>Intitule du devoir</label></td></tr>
				<tr><td><input type='text' name='nomDevoir'></input></td>
				<tr><td class='labelAjoutNote'><label>Date</label></td></tr>
				<tr>
					<td>
						<select name='jourDevoir'>
							<?php for ($jour = 1 ; $jour <= 31 ; $jour++)
									echo "<option value=".$jour.">".str_pad($jour, 2, "0", STR_PAD_LEFT)."</option>"; 
						?>
						</select>
						<select name='moisDevoir'>
							<?php for ($mois = 1 ; $mois <= 12 ; $mois++)
									echo "<option value=".$mois.">".str_pad($mois, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='anneeDevoir'>
							<?php for ($annee = date('Y') ; $annee <= date('Y')+5 ; $annee++)
									echo "<option value=".$annee.">".$annee."</option>";
							?>
						</select>
					</td>
				</tr>
				<tr><td class='labelAjoutNote'><label>Note maximum</label><a class='informationNoteMax' title='Correspond à la note sur laquelle sera noté le devoir' href='#'><img src='./Vue/Images/Icones/information.png'></img></a></td></tr>
				<tr><td><input class='noteCourte' type='text' name='noteMax'></input></td>
				<tr><td class='labelAjoutNote'><label>Coefficient</label></td></tr>
				<tr><td><input class='noteCourte' type='text' name='coefficient'></input></td>
				<tr><td class='labelAjoutNote'><label>Saisissez les notes des étudiants</label></td></tr>
			</table>
			<?php if(isset($listeEleves)){
					echo "<div id='Notes'>";
						echo "<table class='tableauNotes'>";
							for($i = 0; $i < count($listeEleves)/2; $i++){
								echo "<tr>";
										echo "<td class='nomEleveNote'>".$listeEleves[$i]->getNom()." ".$listeEleves[$i]->getPrenom()."</td>";
										echo "<td><input class='inputNote' type='text' name='note".$i."'></input></td>";
								echo "</tr>";
							}
						echo "</table>";
						echo "<table id='tableauNotes2' class='tableauNotes'>";
							for($j = ceil(count($listeEleves)/2); $j < count($listeEleves); $j++){
								echo "<tr>";
										echo "<td class='nomEleveNote'>".$listeEleves[$j]->getNom()." ".$listeEleves[$j]->getPrenom()."</td>";
										echo "<td><input class='inputNote' type='text' name='note".$j."'></input></td>";
								echo "</tr>";
							}
						echo "</table>";
					echo "</div>";
				}
			?>
			<input class='boutonAjouterNote' type='submit' value='Soumettre'></input>
		</form>
	</div>
	<div id='modifierNotes' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('modifierNotes','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutNotes' method='post' action='./index.php'>
			<input type='hidden' name='action' value='ModifierNotes'></input>
			<input type='hidden' name='idDiv' value='modifierNotes'></input>
			<input type='hidden' name='nombreEleve' value='<?php echo count($listeEleves); ?>'></input>
			<input type='hidden' name='idGroupe' value='<?php echo $idGroupeActuel ?>'></input>			
			<input type='hidden' name='nomGroupe' value='<?php echo $nomGroupeActuel ?>'></input>			
			<input type='hidden' name='idCentre' value='<?php echo $idCentreDuGroupeActuel ?>'></input>			
			<input type='hidden' name='nomCentre' value='<?php echo $nomCentreDuGroupeActuel ?>'></input>	
			<input type='hidden' name='idDevoir' value='<?php echo $idDevoir ?>'></input>	
			<table id='tableauAjoutNotes'>
				<tr><td class='titreAjoutNotes'><label>Modifier le devoir</label></td></tr>			
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('modifierNotes',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td class='labelAjoutNote'><label>Selectionner la formation</label></td></tr>
				<tr><td><select name='idFormationDevoirModifie'>
				<?php if(isset($mesFormations)){
						foreach($mesFormations as $formation) 
							echo "<option value=".$formation->getIdFormation().">".$formation->getNomFormation()."</option>"; 
					} 
				?>
				</select></td></tr>
				<tr><td class='labelAjoutNote'><label>Intitule du devoir</label></td></tr>
				<tr><td><input type='text' name='nomDevoirModifie' value="<?php echo $nomDevoir ?>"></input></td>
				<tr><td class='labelAjoutNote'><label>Date</label></td></tr>
				<tr>
					<td>
						<select name='jourDevoirModifie'>
							<option><?php echo $jourDevoir ?></option>
							<?php for ($jour = 1 ; $jour <= 31 ; $jour++)
									echo "<option value=".$jour.">".str_pad($jour, 2, "0", STR_PAD_LEFT)."</option>"; 
						?>
						</select>
						<select name='moisDevoirModifie'>
							<option><?php echo $moisDevoir ?></option>
							<?php for ($mois = 1 ; $mois <= 12 ; $mois++)
									echo "<option value=".$mois.">".str_pad($mois, 2, "0", STR_PAD_LEFT)."</option>";
							?>
						</select>
						<select name='anneeDevoirModifie'>
							<option><?php echo $anneeDevoir ?></option>
							<?php for ($annee = date('Y') ; $annee <= date('Y')+5 ; $annee++)
									echo "<option>".$annee."</option>";
							?>
						</select>
					</td>
				</tr>
				<tr><td class='labelAjoutNote'><label>Note maximum</label><a class='informationNoteMax' title='Correspond à la note sur laquelle sera noté le devoir' href='#'><img src='./Vue/Images/Icones/information.png'></img></a></td></tr>
				<tr><td><input class='noteCourte' type='text' name='noteMaxModifie' value="<?php echo $noteMax ?>"></input></td>
				<tr><td class='labelAjoutNote'><label>Coefficient</label></td></tr>
				<tr><td><input class='noteCourte' type='text' name='coefficientModifie' value="<?php echo $coefficient ?>"></input></td>
				<tr><td class='labelAjoutNote'><label>Saisissez les notes des étudiants</label></td></tr>
			</table>
			<?php if(isset($listeNotesDuDevoir)){
					echo "<div id='Notes'>";
						echo "<table class='tableauNotes'>";
							for($i = 0; $i < count($listeNotesDuDevoir['eleve'])/2; $i++){
								echo "<tr>";
										echo "<td class='nomEleveNote'>".$listeNotesDuDevoir['eleve'][$i]->getNom()." ".$listeNotesDuDevoir['eleve'][$i]->getPrenom()."</td>";
										echo "<td><input class='inputNote' type='text' name='note".$i."' value=".$listeNotesDuDevoir['note'][$i]->getNote()."></input></td>";
								echo "</tr>";
							}
						echo "</table>";
						echo "<table id='tableauNotes2' class='tableauNotes'>";
							for($j = ceil(count($listeNotesDuDevoir['eleve'])/2); $j < count($listeNotesDuDevoir['eleve']); $j++){
								echo "<tr>";
										echo "<td class='nomEleveNote'>".$listeNotesDuDevoir['eleve'][$i]->getNom()." ".$listeNotesDuDevoir['eleve'][$i]->getPrenom()."</td>";
										echo "<td><input class='inputNote' type='text' name='note".$j."' value=".$listeNotesDuDevoir['note'][$i]->getNote()."></input></td>";
								echo "</tr>";
							}
						echo "</table>";
					echo "</div>";
				}
			?>
			<input class='boutonAjouterNote' type='submit' value='Soumettre'></input>
		</form>
	</div>
	<div id='parametresGestionNotes'>
		<ul>	
			<?php echo "<li id='titreGestionNotes'> Notes des élèves du groupe <span class='coloreeSpan'>".$nomGroupeActuel."</span> du centre <span class='coloreeSpan'>".$nomCentreDuGroupeActuel."</span></li>"; ?>
			<?php if(isset($roleEnseignant)){ echo "<li><a href='./index.php?action=ConsulterMesEleves&idCentre=".$idCentreDuGroupeActuel."&idGroupe=".$idCentreDuGroupeActuel."' title='retourner à la gestion des étudiants'>Retour liste des étudiants</a></li>"; } ?>
			<?php if(isset($roleChefCentre)){ echo "<li><a href='./index.php?action=ConsulterMesElevesCC&idCentre=".$idCentreDuGroupeActuel."&idGroupe=".$idCentreDuGroupeActuel."' title='retourner à la gestion des étudiants'>Retour liste des étudiants</a></li>"; } ?>
		</ul>
	</div>
	
	<section id='listeFormationsEvaluees'>
		<h1 id='titreFormationsEvaluees'> Formations evaluées </h1>
			<?php if(isset($listeFormationsEvalueesDuGroupe)){
					echo "<table id='tableauFormationsEvaluees'>";
					foreach($listeFormationsEvalueesDuGroupe as $formation){
						echo "<tr>
								<td class='nomFormationEvaluee'>
									<a href='./index.php?action=ConsulterNotes&idFormation=".$formation->getIdFormation()."&nomFormation=".urlencode($formation->getNomFormation())."&idGroupe=".$idGroupeActuel."&nomGroupe=".urlencode($nomGroupeActuel)."&nomCentre=".urlencode($nomCentreDuGroupeActuel)."&idCentre=".$idCentreDuGroupeActuel."'>".$formation->getNomFormation()."</a>
								</td>
							</tr>";
					}
					echo "</table>";
					$nbPages = ceil($nbListeFormationsEvaluees/20);
					if($nbPages > 1){
						echo "<div class='nbPages'>";
						for ($i = 1; $i <= $nbPages; $i++) 
							echo "<a href='./index.php?action=ConsulterNotes&pageCouranteFormation=".$i."&idFormation=".$formation->getIdFormation()."&nomFormation=".urlencode($formation->getNomFormation())."&idGroupe=".$idGroupeActuel."&nomGroupe=".urlencode($nomGroupeActuel)."&nomCentre=".urlencode($nomCentreDuGroupeActuel)."&idCentre=".$idCentreDuGroupeActuel."'>".$i."</a>";	
						echo "</div>";	
					}
				} else { echo "<p id='noFormationEvaluee'> Ce groupe ne possède aucune evaluation </p>"; }
			?>
		</section>
		<section id='listeDevoirs'>
			<h1 id='titreDevoirs'> Devoirs </h1>
			<?php if(isset($listeDevoirsDuGroupe)){
					echo "<table id='tableauDevoirs'>";
					foreach($listeDevoirsDuGroupe as $devoir){
						echo "<tr>
								<td class='nomDevoirs'>
								<a href='./index.php?action=ConsulterNotes&idFormation=".$idFormation."&nomFormation=".urlencode($nomFormation)."&idDevoir=".$devoir->getIdDevoir()."&nomDevoir=".urlencode($devoir->getNomDevoir())."&noteMax=".$devoir->getNoteMax()."&coefficient=".$devoir->getCoefficient()."&date=".$devoir->getDate()."&idGroupe=".$idGroupeActuel."&nomGroupe=".urlencode($nomGroupeActuel)."&nomCentre=".urlencode($nomCentreDuGroupeActuel)."&idCentre=".$idCentreDuGroupeActuel."'>".$devoir->getNomDevoir()."</a>";
								if(isset($roleEnseignant)){ echo "<a class='suppDevoir' onclick=\"return confirm('Voulez-vous supprimer ce devoir ?');\" title='supprimer ce devoir' href='./index.php?action=SupprimerDevoir&idDevoir=".$devoir->getIdDevoir()."&idGroupe=".$idGroupeActuel."&nomGroupe=".urlencode($nomGroupeActuel)."&idCentre=".$idCentreDuGroupeActuel."&nomCentre=".urlencode($nomCentreDuGroupeActuel)."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; }
							echo "</td></tr>";
					}
					echo "</table>";
					$nbPagesDevoirs = ceil($nbDevoirsGroupe/20);
					if($nbPagesDevoirs > 1){
						echo "<div class='nbPages'>";
						for ($i = 1; $i <= $nbPagesDevoirs; $i++) 
							echo "<a href='./index.php?action=ConsulterNotes&pageCouranteDevoir=".$i."&idFormation=".$idFormation."&nomFormation=".urlencode($nomFormation)."&idDevoir=".$devoir->getIdDevoir()."&nomDevoir=".urlencode($devoir->getNomDevoir())."&noteMax=".$devoir->getNoteMax()."&coefficient=".$devoir->getCoefficient()."&date=".$devoir->getDate()."&idGroupe=".$idGroupeActuel."&nomGroupe=".urlencode($nomGroupeActuel)."&nomCentre=".urlencode($nomCentreDuGroupeActuel)."&idCentre=".$idCentreDuGroupeActuel."'>".$i."</a>";	
						echo "</div>";	
					}
				} else { echo "<p id='noDevoirs'> Ce groupe ne possède aucun devoir </p>"; }
			?>
		</section>
		<section id='listeNotes'>
			<div>
				<h1 id='titreListeNotes'> Notes <?php if(isset($nomFormation, $nomDevoir)){ echo "du devoir <span class=coloreeSpan>".$nomDevoir."</span> du <span class=coloreeSpan>".$jourDevoir."</span> / <span class=coloreeSpan>".$moisDevoir."</span> / <span class=coloreeSpan>".$anneeDevoir."</span> ( <span class=coloreeSpan>".$nomFormation." </span> )"; } ?> </h1>
					<?php if(isset($roleEnseignant)){ ?>
						<div id='parametresGestionNotes2'>
							<ul>
								<li><a onclick=gererAffichageProfondeur('ajouterNotes','blanket6'); title='Ajouter des notes à cette classe' href='#'>Ajouter des notes</a></li>
								<?php if(isset($listeNotesDuDevoir)){ ?>
									<li id='modifierNote'>
										<a onclick=gererAffichageProfondeur('modifierNotes','blanket6');  href='#' class='iconeSupprimerFormation' title='modifier les notes'>
											<img src='./Vue/Images/Icones/modifierCentre.png'></img>
										</a>
									</li>
								<?php } ?>
							</ul>
						</div>
				<?php } ?>
			</div>
				<?php if(isset($listeNotesDuDevoir)){
						echo "<div id='listeTableauxEleves'>";
						echo "<table class='tableauElevesNotes'>";
							for($i = 0; $i < count($listeNotesDuDevoir['eleve'])/2; $i++)
								echo "<tr>
										<td class='nomEleveNotes'>".$listeNotesDuDevoir['eleve'][$i]->getNom()." ".$listeNotesDuDevoir['eleve'][$i]->getPrenom()." : <span class='coloreeSpan'>".$listeNotesDuDevoir['note'][$i]->getNote()."/".$noteMax."</span></td>
									</tr>";
						echo "</table>";
						echo "<table class='tableauElevesNotes'>";
							for($i = ceil(count($listeNotesDuDevoir['eleve'])/2); $i < count($listeNotesDuDevoir['eleve']); $i++)
								echo "<tr><td class='nomEleveNotes'>".$listeNotesDuDevoir['eleve'][$i]->getNom()." ".$listeNotesDuDevoir['eleve'][$i]->getPrenom()." : <span class='coloreeSpan'>".$listeNotesDuDevoir['note'][$i]->getNote()."/".$noteMax."</span></td></tr>";
						echo "</table>";
					echo "</div>";
					echo "<p id='moyenne'> Moyenne de classe: <span class='coloreeSpan'>".$moyenneDevoir."</span>/<span class='coloreeSpan'>".$noteMax."</span> (Coeff.<span class='coloreeSpan'>".$coefficient."</span>)</span></p>";
				} else { echo "<p id='noNotes'> Aucunes notes renseignées </p>"; } 
		?>
		</section>
<?php require_once('./Vue/Footer.php'); ?>