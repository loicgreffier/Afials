<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionEleves".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionElevesBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='mesEleves'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket6'); } </script>";  } ?>	
	<?php if(isset($idCentreSelect,$nomCentreSelect,$cpCentreSelect)){ echo "<script> window.onload = function(){ gererAffichageProfondeur('ajouterGroupeExistant','blanket6'); } </script>";  } ?>	
	<div id='blanket6' style='display:none'></div>
	<div id='ajouterClasse' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterClasse','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form enctype="multipart/form-data" id='formulaireAjoutClasse' method='post' action='./index.php'>
			<?php if(isset($roleEnseignant)){ echo "<input type='hidden' name='action' value='AjouterClasse'></input>"; } ?>
			<?php if(isset($roleChefCentre)){ echo "<input type='hidden' name='action' value='AjouterClasseCC'></input>"; } ?>
			<input type='hidden' name='idDiv' value='ajouterClasse'></input>
			<input type='hidden' name='tailleMaxFichier' value='3000' />
			<table id='tableauAjoutClasse'>
				<tr><td class='titreAjoutClasse'><label>Nouvelle Classe</label></td></tr>			
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterClasse',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr>
					<td>
						<label>Choisissez votre centre</label>
						<a href='#' title="Si votre centre n'est pas disponible, veuillez l'ajouter via Gestion > Mes centres de formation"><img src='./Vue/Images/Icones/information.png'/></a>
					</td>
				</tr>
				<tr><td><select name='idCentre'>
							<option value=""> Selectionner un centre </option>
					<?php if(isset($centresFormation)){
							foreach($centresFormation as $centre)
								echo "<option value=".$centre->getIdCentre().">".$centre->getNomCentre()."</option>"; 
						}
					?>
				</select></td></tr>
				<tr><td class='labelAjoutClasse'><label>Nom de la classe</label></td></tr>
				<tr><td><input type='text' name='nomClasse'></input>
				<tr><td class='labelAjoutClasse'><label>Génération</label><a class='informationNoteMax' title="Correspond aux années durant lesquelles le groupe fera parti de l'établissement" href='#'><img src='./Vue/Images/Icones/information.png'></img></a></td></tr>
				<tr>
					<td id='selecteAnneeEntree'>
						<select name='anneeEntree'>
							<?php for($i = date("Y"); $i <= date("Y")+5; $i++) echo "<option>".$i."</option>"; ?>
						</select>
						<label>/</label>
						<select name='anneeSortie'>
					<?php for($i = date("Y"); $i <= date("Y")+5; $i++) echo "<option>".$i."</option>"; ?>
						</select>
					</td>
				</tr>
				<tr><td class='labelAjoutClasse'><label>Année d'étude</label><a class='informationNoteMax' title="Indique, par exemple, s'il s'agit d''un groupe de 1ère ou de 2ème année" href='#'><img src='./Vue/Images/Icones/information.png'></img></a></td></tr>
				<tr><td><select name='anneeEtude'>
					<?php for($i = 1; $i <= 8; $i++) echo "<option>".$i."</option>"; ?>
				</select></td></tr>
				<tr><td class='labelAjoutClasse'><label>Fichier listant les élèves (facultatif)</label></td></tr>
				<tr><td><input name='fichierClasse' type="file"></input>
				<tr><td class='labelAjoutClasse'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='ajouterGroupeExistant' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterGroupeExistant','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form enctype="multipart/form-data" id='formulaireAjoutGroupeExistant' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterGroupeExistant'></input>
			<input type='hidden' name='idDiv' value='ajouterGroupeExistant'></input>
			<table id='tableauAjoutGroupeExistant'>
				<tr><td class='titreAjoutGroupeExistant'><label>Groupe Existant</label></td></tr>
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterGroupeExistant',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>				
				<tr><td><select name="idCentre" onChange="document.location=this.options[this.selectedIndex].value;">
					<?php if(isset($centresFormation)){
							if(isset($idCentreSelect,$nomCentreSelect)){
								echo "<option value=".$idCentreSelect.">".$nomCentreSelect." (".substr($cpCentreSelect,0,2).")</option>";
							} 
							foreach($centresFormation as $centre){
								if(!isset($idCentreSelect)){
									echo "<option value='./index.php?action=".$actionConsulterEleves."&idCentreSelect=".$centre->getIdCentre()."&nomCentreSelect=".$centre->getNomCentre()."&cp=".$centre->getCodePostal()."'>".$centre->getNomCentre()." (".substr($centre->getCodePostal(),0,2).")</option>"; 
								} else {
									if($centre->getIdCentre() != $idCentreSelect)
										echo "<option value='./index.php?action=".$actionConsulterEleves."&idCentreSelect=".$centre->getIdCentre()."&nomCentreSelect=".$centre->getNomCentre()."&cp=".$centre->getCodePostal()."'>".$centre->getNomCentre()." (".substr($centre->getCodePostal(),0,2).")</option>"; 
								}
							}
						} else { echo "<option value=''>Aucun centre de formation</option>"; }
					?>
				</select></td></tr>
				<tr><td><select name='idGroupe'>
							<option value=""> Selectionner un groupe </option>
				<?php if(isset($listeGroupesParCentre)){
						foreach($listeGroupesParCentre as $groupe) 
							echo "<option value=".$groupe->getIdGroupe().">".$groupe->getNomGroupe()."</option>"; 
					}
				?>
				</select></td></tr>
				<tr><td class='labelAjoutClasse'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='ajouterUnEtudiant' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterUnEtudiant','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutUnEtudiant' method='post' action='./index.php'>
			<?php if(isset($roleEnseignant)){ echo "<input type='hidden' name='action' value='AjouterUnEtudiant'></input>"; } ?>
			<?php if(isset($roleChefCentre)){ echo "<input type='hidden' name='action' value='AjouterUnEtudiantCC'></input>"; } ?>
			<input type='hidden' name='idGroupe' value='<?php echo $idGroupe ?>'></input>
			<input type='hidden' name='idDiv' value='ajouterUnEtudiant'></input>
			<table id='tableauAjoutUnEtudiant'>
				<tr><td class='titreAjoutUnEtudiant'><label>Nouvel étudiant</label></td></tr>			
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterUnEtudiant',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td><label>Nom</label></td></tr>
				<tr><td><input type='text' name='nomEtudiant'></input>
				<tr><td class='labelAjoutUnEtudiant'><label>Prénom</label></td></tr>
				<tr><td><input type='text' name='prenomEtudiant'></input>
				<tr><td class='labelAjoutUnEtudiant'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='ajouterPlusieursEleves' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterPlusieursEleves','blanket6')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form enctype="multipart/form-data" id='formulaireAjoutPlusieursEleves' method='post' action='./index.php'>
			<?php if(isset($roleEnseignant)){ echo "<input type='hidden' name='action' value='AjouterPlusieursEleves'></input>"; } ?>
			<?php if(isset($roleChefCentre)){ echo "<input type='hidden' name='action' value='AjouterPlusieursElevesCC'></input>"; } ?>
			<input type='hidden' name='idGroupe' value='<?php echo $idGroupe ?>'></input>
			<input type='hidden' name='idDiv' value='ajouterPlusieursEleves'></input>
			<input type='hidden' name='tailleMaxFichier' value='3000' />
			<table id='tableauAjoutPlusieursEleves'>
				<tr><td class='titreAjoutPlusieursEleves'><label>Ajouter plusieurs élèves</label></td></tr>	
				<?php if(isset($this->tableauErreurs)){
						if(in_array('ajouterPlusieursEleves',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutClasse'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
					}
				?>
				<tr><td class='labelAjoutPlusieursEleves'><label>Fichier listant les élèves</label></td></tr>
				<tr><td><input name='fichierClasse' type="file"></input>
				<tr><td class='labelAjoutClasse'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='parametresEleves'>
		<ul>	
			<li id='titreEleves'> Mes elèves </li>
			<li><a href='#' onclick=gererAffichageProfondeur('ajouterClasse','blanket6') title='Ajouter un nouveau groupe'>Nouveau groupe</a></li>
			<?php if(isset($roleEnseignant)){ echo "<li><a href='#' onclick=gererAffichageProfondeur('ajouterGroupeExistant','blanket6') title='Ajouter un nouveau groupe'>Groupe existant</a></li>"; } ?>
		</ul>
	</div>
	
	<div id='sections'>
		<section id='listeCentreFormation'>
		<h1 id='titreListeCentres'> Mes centres </h1>
			<?php if(isset($centresFormation)){
					echo "<table class='tableauCentre'>";
					foreach($centresFormation as $centre){
						echo "<tr>
								<td class='nomCentre'>
									<a href='./index.php?action=".$actionConsulterEleves."&idCentre=".$centre->getIdCentre()."&nomCentre=".urlencode($centre->getNomCentre())."'>".$centre->getNomCentre()." (".substr($centre->getCodePostal(),0,2).")</a>
								</td>
							</tr>";
					}
					echo "</table>";
					$nbPagesCentres = ceil($nbCentresFormation/20);
					if($nbPagesCentres > 1){
						echo "<div class='nbPagesCentresFormation'>";
						for ($i = 1; $i <= $nbPagesCentres; $i++) 
							echo "<a href='./index.php?action=".$actionConsulterEleves."&pageCouranteCentresFormation=".$i."&idCentre=".$centre->getIdCentre()."&nomCentre=".urlencode($centre->getNomCentre())."'>".$i."</a>";	
						echo "</div>";	
					}
				} else { echo "<p id='noCentre'> Vous n'avez aucun centre, vous pouvez en ajouter <a id='addCentre' href='./index.php?action=ConsulterMesCentresFormation'>ici</a></p>"; }
			?>
		</section>
		<section id='listeGroupe'>
			<?php if(isset($roleEnseignant)){ echo "<h1 id='titreListeCentres'> Groupes à charge </h1>"; } ?> 
			<?php if(isset($roleChefCentre)){ echo "<h1 id='titreListeCentres'> Tout les groupes </h1>"; } ?>
			<?php if(isset($listeGroupes)){
					echo "<table class='tableauGroupe'>";
					foreach($listeGroupes as $groupe){
						echo "<tr>
								<td class='nomGroupe'>
								<a href='./index.php?action=".$actionConsulterEleves."&idCentre=".$idCentre."&nomCentre=".urlencode($nomCentre)."&idGroupe=".$groupe->getIdGroupe()."&nomGroupe=".urlencode($groupe->getNomGroupe())."'>".$groupe->getNomGroupe()."</a>";
								if(isset($roleEnseignant)){ echo "<a class='suppGroupe' onclick=\"return confirm('Voulez-vous supprimer ce groupe de la liste des groupes dont vous êtes responsable ?');\" title='supprimer ce groupe' href='./index.php?action=SupprimerGroupe&idGroupe=".$groupe->getIdGroupe()."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; }
								if(isset($roleChefCentre)){ echo "<a class='suppGroupe' onclick=\"return confirm('ATTENTION: CE GROUPE SERA DEFINITIVEMENT SUPPRIMER DE L\'ETABLISSEMENT ?');\" title='supprimer ce groupe' href='./index.php?action=SupprimerGroupeCC&idGroupe=".$groupe->getIdGroupe()."'><img src='./Vue/Images/Icones/supprimergroupe.png'></img></a>"; }
							echo "</tr>";
					}
					echo "</table>";
					$nbPagesCentres = ceil($nbCentresFormation/20);
					if($nbPagesCentres > 1){
						echo "<div class='nbPagesCentresFormation'>";
						for ($i = 1; $i <= $nbPagesCentres; $i++) 
							echo "<a href='./index.php?action=".$actionConsulterEleves."&pageCouranteCentresFormation=".$i."&idCentre=".$idCentre."&nomCentre=".urlencode($nomCentre)."&idGroupe=".$groupe->getIdGroupe()."&nomGroupe=".urlencode($groupe->getNomGroupe())."'>".$i."</a>";	
						echo "</div>";	
					}
				} else { echo "<p id='noGroupe'> Pas de groupe dans ce centre </p>"; }
			?>
		</section>
		<section id='listeEleves'>
			<div id='enteteEleve'>
				<h1 id='titreListeEleves'> Elèves <?php if(isset($nomGroupe, $nomCentre)){ echo "du groupe <span class='coloreeSpan'>".$nomGroupe."</span> ( <span class='coloreeSpan'>".$nomCentre."</span> )"; } ?> </h1>
				<?php if(isset($idGroupe)){ ?>
					<div id='parametresEleves2'>
						<ul>
							<li><a onclick=gererAffichageProfondeur('ajouterUnEtudiant','blanket6') title='Ajouter un élève à cette classe' href='#'>Ajouter un élève</a></li>
							<li><a onclick=gererAffichageProfondeur('ajouterPlusieursEleves','blanket6') title='Ajouter des élèves à cette classe par fichier' href='#'>Ajouter plusieurs élèves</a></li>
							<?php echo "<li><a title='Consulter les notes de cette classe' href='./index.php?action=ConsulterNotes&idGroupe=".$idGroupe."&nomGroupe=".urlencode($nomGroupe)."&nomCentre=".urlencode($nomCentre)."&idCentre=".$idCentre."'>Gestion des notes</a></li>"; ?>
						</ul>
					</div>
				<?php } ?>
			</div>
			<?php if(isset($listeEleves)){
					echo "<div id='listeTableauxEleves'>";
						echo "<table class='tableauEleves'>";
							for($i = 0; $i < count($listeEleves)/2; $i++){
								echo "<tr>
										<td class='nomEleve'>".$listeEleves[$i]->getNom()." ".$listeEleves[$i]->getPrenom()." (".$listeEleves[$i]->getLogin().")</td>";
										if(isset($roleEnseignant)){ echo "<td><a class='suppEleve' onclick=\"return confirm('Voulez-vous supprimer cet élève ?');\" title='supprimer cet élève' href='./index.php?action=SupprimerEleve&loginEleve=".urlencode($listeEleves[$i]->getLogin())."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; } 
										if(isset($roleChefCentre)){ echo "<td><a class='suppEleve' onclick=\"return confirm('Voulez-vous supprimer cet élève ?');\" title='supprimer cet élève' href='./index.php?action=SupprimerEleveCC&loginEleve=".urlencode($listeEleves[$i]->getLogin())."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; } 
								echo "</tr>";
							}
						echo "</table>";
						echo "<table class='tableauEleves'>";
							for($i = ceil(count($listeEleves)/2); $i < count($listeEleves); $i++){
								echo "<tr>
										<td class='nomEleve'>".$listeEleves[$i]->getNom()." ".$listeEleves[$i]->getPrenom()." (".$listeEleves[$i]->getLogin().")</td>";
										if(isset($roleEnseignant)){ echo "<td><a class='suppEleve' onclick=\"return confirm('Voulez-vous supprimer cet élève ?');\" title='supprimer cet élève' href='./index.php?action=SupprimerEleve&loginEleve=".urlencode($listeEleves[$i]->getLogin())."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; } 
										if(isset($roleChefCentre)){ echo "<td><a class='suppEleve' onclick=\"return confirm('Voulez-vous supprimer cet élève ?');\" title='supprimer cet élève' href='./index.php?action=SupprimerEleveCC&loginEleve=".urlencode($listeEleves[$i]->getLogin())."'><img src='./Vue/Images/Icones/supprimer.png'></img></a>"; } 
									echo "</tr>";
							}
						echo "</table>";
					echo "</div>";
				} else { echo "<p id='noEleves'> Aucun elève dans ce groupe </p>"; } 
			?>
		</section>
	</div>
</article>
<?php require_once('./Vue/Footer.php'); ?>