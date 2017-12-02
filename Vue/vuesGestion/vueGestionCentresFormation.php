<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueCentresFormation".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueCentresFormationBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='mesCF'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup']))
			if($this->tableauErreurs['erreurAfficherPopup'] == "modifierCentreFormation"){
				echo "<script> window.onload = function(){ gererModificationCentre('modifierCentreFormation','blanket4','idModifierCentre','modifierNomCentre','modifierVilleCentre','modifierRueCentre','modifierCpCentre',
																				   '".$idCentreModifie."','".addslashes($nomCentreModifie)."','".addslashes($villeCentreModifie)."','".addslashes($rueCentreModifie)."','".$cpCentreModifie."'); } </script>";
			} else { echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket4'); } </script>"; }  
	?>	
	<div id='blanket4' style='display:none'></div>
	<div id='ajouterCentreFormation' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterCentreFormation','blanket4')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form class='formulaireAjoutCentreFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterCentreFormation'/>
			<input type='hidden' name='idDiv' value='ajouterCentreFormation'/>
			<input type='hidden' name='loginEnseignantAjoutant' value='<?php echo $loginPersonneConnectee ?>'/>
			<table class='tableauAjoutCentreFormation'>
				<tr><td colspan=4 id='titreAjoutCentreFormation'><label>Ajouter un nouveau centre</label></td></tr>			
				<?php if(isset($this->tableauErreurs)){ 
						if(in_array('ajouterCentreFormation',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=4 class='messageErreurAjoutCentreFormation'><label>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
					}
				?>
				<tr>
					<td colspan=2><label>Nom du centre: </label></td>
					<td><input type='text' name='nomCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Ville: </label></td>
					<td><input type='text' name='villeCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Rue / lieu dit: </label></td>
					<td><input type='text' name='rueCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Code postal: </label></td>
					<td><input type='text' name='cpCentreFormation'></input></td>
				</tr>
				<tr><td colspan=4 id='titreChefDeCentre'><label>Choisissez un chef de centre</label></td></tr>
				<tr><td colspan=4 class='titreChefChoix'><label>Selectionnez un chef existant</label></td></tr>
				<tr><td colspan=4>
						<select name='loginChefCentre'>
							<option value="">Selectionner un chef</option>
							<?php if(isset($listeChefsCentre)){
										foreach($listeChefsCentre as $chef)
											echo "<option value=".$chef->getLogin().">".$chef->getNom()." ".$chef->getPrenom()."</option>"; 
								}
								?>
						</select>
				</td></tr>
				</tr><td colspan=4 class='titreChefChoix'><label>Ou ajouter un nouveau chef</label></td></tr>
				<tr>
					<td colspan=2><label>Nom: </label></td>
					<td><input type='text' name='nomCC'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Prénom: </label></td>
					<td><input type='text' name='prenomCC'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Email: </label></td>
					<td><input type='text' name='emailCC'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Telephone: </label></td>
					<td><input type='text' name='telCC'></input></td>
				</tr>
				<tr><td colspan=4 class='BouttonAjouterCentre'><input type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='ajouterCentreFormationExistant' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterCentreFormationExistant','blanket4')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form class='formulaireAjoutCentreFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterCentreFormationExistant'/>
			<input type='hidden' name='idDiv' value='ajouterCentreFormationExistant'/>
			<input type='hidden' name='loginPersonne' value='<?php echo $loginPersonneConnectee ?>'/>
			<table class='tableauAjoutCentreFormation'>
				<tr>
					<td id='titreAjoutCentreFormation'><label>Selectionner un centre de formation</label>
					<a href='#' title="Si le centre que vous désirez n'est pas disponible, veuillez l'ajouter via l'onglet 'Nouveau centre'"><img src='./Vue/Images/Icones/information.png'/></a>
					</td>
				</tr>		
				<?php if(isset($this->tableauErreurs)){ 
						if(in_array('ajouterCentreFormationExistant',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=4 class='messageErreurAjoutCentreFormation'><label>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
					}
				?>
				<tr><td>
					<select name='idCentre'>
						<option value=""> Selectionner un centre existant </option>
						<?php if(isset($listeTousLesCentres)){
									foreach($listeTousLesCentres as $centre)
										echo "<option value=".$centre->getIdCentre().">".$centre->getNomCentre()." à ".$centre->getNomVille()." (".substr($centre->getCodePostal(),0,2).")</option>"; 
							}
						?>
					</select>
				</td></tr>
				<tr><td class='BouttonAjouterCentre'><input type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='modifierCentreFormation' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('modifierCentreFormation','blanket4')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form class='formulaireAjoutCentreFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='ModifierCentreFormation'/>
			<input type='hidden' name='idDiv' value='modifierCentreFormation'/>
			<input type='hidden' name='idCentre' id='idModifierCentre'/>
			<table class='tableauAjoutCentreFormation'>
				<tr><td colspan=4 id='titreAjoutCentreFormation'><label>Modifier ce nouveau centre</label></td></tr>			
				<?php if(isset($this->tableauErreurs)){ 
						if(in_array('modifierCentreFormation',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=4 class='messageErreurAjoutCentreFormation'><label>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
					}
				?>
				<tr>
					<td colspan=2><label>Nom du centre: </label></td>
					<td><input id='modifierNomCentre' type='text' name='nomCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Ville: </label></td>
					<td><input id='modifierVilleCentre' type='text' name='villeCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Rue / lieu dit: </label></td>
					<td><input id='modifierRueCentre' type='text' name='rueCentreFormation'></input></td>
				</tr>
				<tr>
					<td colspan=2><label>Code postal: </label></td>
					<td><input id='modifierCpCentre' type='text' name='cpCentreFormation'></input></td>
				</tr>
				<tr><td colspan=4 class='titreChefChoix'><label>Selectionner un nouveau chef centre</label></td></tr>
				<tr><td colspan=4>
						<select name='loginNouveauChefCentre'>
							<option value="">Selectionner un chef</option>
							<?php if(isset($listeChefsCentre)){
										foreach($listeChefsCentre as $chef)
											echo "<option value=".$chef->getLogin().">".$chef->getNom()." ".$chef->getPrenom()."</option>"; 
								}
								?>
						</select>
				</td></tr>
				<tr><td colspan=4 class='BouttonAjouterCentre'><input type='submit' value='Mettre à jour'></input></td></tr>
			</table>
		</form>
	</div>
	
	<div id='parametresCF'>
		<ul> 
			<li id='titreCF'>Mes centres de formations</li>
			<li><a title='Ajouter un nouveau centre' href='#' onclick=gererAffichageProfondeur('ajouterCentreFormation','blanket4')>Nouveau centre</a></li>
			<li><a title='Ajouter un centre existant' href='#' onclick=gererAffichageProfondeur('ajouterCentreFormationExistant','blanket4')>Centres existants</a></li>
		</ul>
	</div>
	
	<table id='tableauCF'>
		<tr>
			<td class='enteteTableauCF'> Centre </td>
			<td class='enteteTableauCF'> Ville </td>
			<td class='enteteTableauCF'> Rue / lieu dit </td>
			<td class='enteteTableauCF'> Code postal </td>
			<td class='enteteTableauCF'> Chef centre </td>
		</tr>
<?php	if(isset($centresFormation,$chefCentre)){
			$i = 0;
			foreach($centresFormation as $centre){
				echo "<tr class='trVariableTableauCF'>
						<td class='variableTableauCF'>".$centre->getNomCentre()."</td>
						<td class='variableTableauCF'>".$centre->getNomVille()."</td>
						<td class='variableTableauCF'>".$centre->getNomRue()."</td>
						<td style='width: 160px' class='variableTableauCF'>".$centre->getCodePostal()."</td>
						<td style='width: 500px' class='variableTableauCFChefCentre'>
							<a title='afficher les details' onclick=\"gererAffichage('idTelEmail".$i."');\" href='#'>".$chefCentre[$centre->getIdCentre()]->getNom(). " " .$chefCentre[$centre->getIdCentre()]->getPrenom()."</a>
							<p style='display: none' class='telEmail' id='idTelEmail".$i."'>".$chefCentre[$centre->getIdCentre()]->getEmail()." / ".$chefCentre[$centre->getIdCentre()]->getTel()."</p>
						</td>
						<td class='iconeSupprimerCentre'>
							<a onclick=\"return confirm('Voulez-vous supprimer ce centre ?');\" title='supprimer ce centre' href='./index.php?action=SupprimerCentreFormation&idCentre=".$centre->getIdCentre()."'>
								<img src='./Vue/Images/Icones/supprimer.png'></img>
							</a>
						</td>
						<td class='iconeModifierCentre'>
							<a href='#' onclick=\"gererModificationCentre('modifierCentreFormation','blanket4','idModifierCentre','modifierNomCentre','modifierVilleCentre','modifierRueCentre','modifierCpCentre',
																		  '".$centre->getIdCentre()."','".addslashes($centre->getNomCentre())."','".addslashes($centre->getNomVille())."','".addslashes($centre->getNomRue())."','".$centre->getCodePostal()."')\" title='modifier ce centre'>
								<img class='supprimerCentre' src='./Vue/Images/Icones/modifierCentre.png'></img>
							</a>
						</td>							
					</tr>";
				$i++;
			}
		} else {  echo "<h1 id='noCF'> Vous n'avez pas de centres de formation</h1>"; }
	echo "<table>";
	if(isset($centresFormation)){
		$nbPagesCentresFormation = ceil($nbCentresFormation/20); 
		if($nbPagesCentresFormation > 1){
			echo "<div class='nbPagesCentresFormation'>";
				    for ($i = 1; $i <= $nbPagesCentresFormation; $i++)
						echo "<a href='./index.php?action=ConsulterMesCentresFormation&loginEnseignant=".$loginEnseignantConnecte."&pageCouranteCentresFormation=".$i."'>".$i."</a>";	
			echo "</div>";
		}
	}
?>
</article>
<?php require_once('./Vue/Footer.php'); ?>