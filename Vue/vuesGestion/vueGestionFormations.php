<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionFormations".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionFormationsBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='mesFormations'>
<?php if(isset($this->tableauErreurs['erreurAfficherPopup']))
		if($this->tableauErreurs['erreurAfficherPopup'] == "modifierFormation"){ 
			echo "<script> window.onload = function(){ modifierFormation('modifierFormation','blanket2','modifierNomFormation','modifierDescriptifFormation','modifierIdFormation','".$idFormationModifie."','".addslashes($nomFormationModifie)."','".addslashes($descriptifFormationModifie)."'); } </script>";  
		} else { echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket2'); } </script>";  } 
?>
	<div id='blanket2' style='display:none'></div>
	<div id='ajouterFormation' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterFormation','blanket2')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterFormation'/>
			<input type='hidden' name='idDiv' value='ajouterFormation'/>
			<input type='hidden' name='loginEnseignant' value='<?php echo $loginPersonneConnectee ?>'/>
			<table id='tableauAjoutFormation'>
				<tr><td class='titreAjoutFormation'><label>Nouvelle formation</label></td></tr>			
				<?php if(isset($this->tableauErreurs))
						if(in_array('ajouterFormation',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td><label class='messageErreurAjoutFormation'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td><label>Nom formation</label></td></tr>
				<tr><td class='champFormation'><input id='inputNomFormation' type='text' name='nomFormation'></input></td></tr>
				<tr><td><label>Descriptif</label></td></tr>
				<tr><td class='champFormation'><textarea id='descriptifFormation' maxlength='1000' type='text' name='descriptif'></textarea></td></tr>
				<tr>
					<td><label>Type de formation</label>
						<a href='#' title="Si aucun type n'est disponible veuillez en ajouter via l'onglet 'Nouveau type de formation'"><img src='./Vue/Images/Icones/information.png'/></a>
					</td>
				</tr>
				<tr><td><select name='nomTypeFormation'>
							<option value=''> Selectionner un type de formation </option>
					<?php if(isset($listeTypesFormation)){ 
							foreach($listeTypesFormation as $type)
								echo "<option>".$type->getNomTypeFormation()."</option>";
						}
					?>
					</select>
				</td></tr>
				<tr><td class='champAjoutFormation'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='ajouterTypeFormation' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterTypeFormation','blanket2')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutTypeFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterTypeFormation'/>
			<input type='hidden' name='idDiv' value='ajouterTypeFormation'/>
			<table id='tableauAjoutTypeFormation'>
				<tr><td colspan=2 id='titreAjoutTypeFormation'><label>Ajouter un nouveau type de formation</label></td></tr>			
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterTypeFormation',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td colspan=2><label class='messageErreurAjoutFormation'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr>
					<td>
						<label>Types existants</label>
						<a href='#' title="Voici la liste des types de formations disponibles. Si celui que vous désirez n'existe pas, veuillez l'ajouter via le champ de saisie ci-contre"><img src='./Vue/Images/Icones/information.png'/></a>
					</td>
					<td><label>Nouveau type</label></td>
				</tr>
				<tr>
					<td><select name='nomTypeFormation'>
					<?php if(isset($listeTypesFormation)){ 
							foreach($listeTypesFormation as $type)
								echo "<option>".$type->getNomTypeFormation()."</option>";
						} else { echo "<option value=''> Aucun type de formation disponible </option>"; }
					?>
					</select></td>
					<td class='champFormation'><input type='text' name='nomTypeFormation'></input></td>
				</tr>
				<tr><td colspan=2 class='champAjoutFormation'><input class='bouttonAjouterFormulaire' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	<div id='modifierFormation' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('modifierFormation','blanket2')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutFormation' method='post' action='./index.php'>
			<input type='hidden' name='action' value='ModifierFormation'/>
			<input type='hidden' name='idDiv' value='modifierFormation'/>
			<input type='hidden' name='modifierIdFormation' id='modifierIdFormation'/>
			<table id='tableauAjoutFormation'>
				<tr><td class='titreAjoutFormation'><label>Modifier la formation</label></td></tr>			
				<?php if(isset($this->tableauErreurs))
						if(in_array('modifierFormation',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td><label class='messageErreurAjoutFormation'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td><label>Nom formation</label></td></tr>
				<tr><td class='champFormation'><input id='modifierNomFormation' type='text' name='modifierNomFormation'></input></td></tr>
				<tr><td><label>Descriptif</label></td></tr>
				<tr><td class='champFormation'><textarea id='modifierDescriptifFormation' maxlength='1000' type='text' name='modifierDescriptifFormation'></textarea></td></tr>
				<tr><td><label>Type de formation</label></td></tr>
				<tr><td><select name='nomTypeFormation'>
					<?php if(isset($listeTypesFormation)){ 
							echo "<option value=\"\">Selectionner un type de formation</option>";
							foreach($listeTypesFormation as $type)
								echo "<option>".$type->getNomTypeFormation()."</option>";
						}
					?>
					</select>
				</td></tr>
				<tr><td class='champAjoutFormation'><input class='bouttonAjouterFormulaire' type='submit' value='Mettre à jour'></input></td></tr>
			</table>
		</form>
	</div>
	
	<div id='parametresFormation'>
		<ul> 
			<li id='titreMesFormations'>Mes formations</li>
			<li><a title='Ajouter une formation' href='#' onclick=gererAffichageProfondeur('ajouterFormation','blanket2')>Nouvelle formation</a></li>
			<li><a title='Ajouter un type de formation' href='#' onclick=gererAffichageProfondeur('ajouterTypeFormation','blanket2')>Nouveau type de formation</a></li>
		</ul>
	</div>	
	<?php if(isset($formationsEnseignant)){ ?>
			<div id='tableauxMesFormations'>
				<?php foreach($formationsEnseignant as $formation){ 
						echo "<div class='divTableauFormation'>
								<a title='supprimer cette formation' onclick=\"return confirm('Voulez-vous supprimer cette formation ?');\" class='iconeSupprimerFormation' href='./index.php?action=SupprimerFormation&idFormation=".$formation->getIdFormation()."'>
									<img src='./Vue/Images/Icones/supprimer.png'></img>
								</a>
								<a href='#' onclick=\"modifierFormation('modifierFormation','blanket2','modifierNomFormation','modifierDescriptifFormation','modifierIdFormation','".$formation->getIdFormation()."','".$formation->getNomFormation()."','".addslashes($formation->getDescriptif())."');\" class='iconeSupprimerFormation' title='modifier cette formation'>
									<img src='./Vue/Images/Icones/modifierCentre.png'></img>
								</a>
								<table class='tableauFormations'>
									<tr class='intituleFormation'>
										<td class='nomFormation' colspan=2>".$formation->getNomFormation()."</td>
									</tr>
									<tr>
										<td class='labelTypeFormation'>Type de formation: </td>
										<td class='typeFormation'>".$formation->getNomTypeFormation()."</td>
									</tr>
									<tr>
										<td class='descriptif' colspan=3><p>".$formation->getDescriptif()."</p></td>
									</tr>
								</table>
							</div>";
					} 
			echo "</div>";
			$nbPagesFormations = ceil($nbFormationEnseignant/5);
			if($nbPagesFormations > 1){
				echo "<div class='nbPagesFormation'>";
				for ($i = 1; $i <= $nbPagesFormations; $i++)
					echo "<a href='./index.php?action=ConsulterMesFormations&loginEnseignant=".urlencode($loginEnseignantConnecte)."&pageCouranteFormation=".$i."'>".$i."</a>";	
				echo "</div>";	
			}
		} else { echo "<h1 id='noFormations'> Vous n'avez pas de formations</h1>"; }
	?>
</article>
<?php require_once('./Vue/Footer.php'); ?>