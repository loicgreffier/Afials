<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionMonCompte".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionMonCompteBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='monCompte'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket10'); } </script>";  } ?>	
		<div id='blanket10' style='display:none'></div>
		<div id='modifierMdp' style='display:none'>
			<a class='fermer' href='#' onclick=gererAffichageProfondeur('modifierMdp','blanket10')><img src='./Vue/Images/Icones/fermer.png'></img></a>
			<form id='formulaireModifierMdp' method='post' action='./index.php'>
				<input type='hidden' name='action' value='ModifierMdp'/>
				<input type='hidden' name='idDiv' value='modifierMdp'/>
				<input type='hidden' name='loginPersonneConnectee' value='<?php echo $loginPersonneConnectee ?>'/>
				<table id='tableauModifierMdp'>
					<tr><td class='titreModifierMdp'><label>Modifier mon mot de passe</label></td></tr>			
					<?php if(isset($this->tableauErreurs))
							if(in_array('modifierMdp',$this->tableauErreurs)){
								for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
									echo "<tr><td><label class='messageErreurModifierMdp'>".$this->tableauErreurs[$i]."</label></td></tr>";	
							}
					?>
					<tr><td><label>Mot de passe actuel</label></td></tr>
					<tr><td><input type='password' name='mdpActuel'></td></tr>
					<tr><td><label>Nouveau mot de passe</label></td></tr>
					<tr><td><input type='password' name='nouveauMdp'></td></tr>
					<tr><td><label>Confirmer le nouveau mot de passe</label></td></tr>
					<tr><td><input type='password' name='nouveauMdpConfirmation'></td></tr>
					<tr><td id='modifierMdpButton'><input type='submit' value='Modifier'></input></td></tr>
				</table>
			</form>
		</div>
		<?php if(isset($informationsPersonne, $telephoneSyntaxe)){ ?>
		<div id='modifierInformations' style='display:none'>
			<a class='fermer' href='#' onclick=gererAffichageProfondeur('modifierInformations','blanket10')><img src='./Vue/Images/Icones/fermer.png'></img></a>
			<form id='formulaireModifierInformations' method='post' action='./index.php'>
				<input type='hidden' name='action' value='ModifierInformations'/>
				<input type='hidden' name='idDiv' value='modifierInformations'/>
				<input type='hidden' name='loginPersonneConnectee' value='<?php echo $loginPersonneConnectee ?>'/>
				<table id='tableauModifierInformations'>
					<tr><td class='titreModifierInformations'><label>Modifier vos informations</label></td></tr>			
					<?php if(isset($this->tableauErreurs))
							if(in_array('modifierInformations',$this->tableauErreurs)){
								for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
									echo "<tr><td><label class='messageErreurModifierInformations'>".$this->tableauErreurs[$i]."</label></td></tr>";	
							}
					?>
					<tr><td><label>Nom</label></td></tr>
					<tr><td><input type='text' name='nomModifier' value='<?php echo $informationsPersonne->getNom() ?>'></td></tr>
					<tr><td><label>Prénom</label></td></tr>
					<tr><td><input type='text' name='prenomModifier' value='<?php echo $informationsPersonne->getPrenom() ?>'></td></tr>
					<tr><td><label>Email</label></td></tr>
					<tr><td><input type='text' name='emailModifier' value='<?php echo $informationsPersonne->getEmail() ?>'></td></tr>
					<tr><td><label>Téléphone</label></td></tr>
					<tr><td><input type='text' name='telModifier' value='<?php echo $telephoneSyntaxe ?>'></td></tr>
					<tr><td id='modifierInformationsButton'><input type='submit' value='Modifier'></input></td></tr>
				</table>
			</form>
		</div>
		<?php } ?>
	
<div id='parametresMonCompte'>
	<ul> 
		<li id='titreMonCompte'>Mon compte</li>
		<li><a title='Modifier mon mot de passe' href='#' onclick=gererAffichageProfondeur('modifierMdp','blanket10')>Modifier mot de passe</a></li>
		<li><a title='Modifier mon téléphone ou mon email' href='#' onclick=gererAffichageProfondeur('modifierInformations','blanket10')>Modifier informations</a></li>
	</ul>
</div>

<?php if(isset($informationsPersonne)){ ?>
	<table>
		<tr>
			<td class='labelTableauDesInformations'> Status sur le site: </td>
			<td class='varTableauDesInformations'> <?php echo $informationsPersonne->getRole() ?></td>
		</tr>
		<tr>
			<td class='labelTableauDesInformations'> Login: </td>
			<td class='varTableauDesInformations'> <?php echo $informationsPersonne->getLogin() ?></td>
		</tr>
		<tr>
			<td class='labelTableauDesInformations'> Nom: </td>
			<td class='varTableauDesInformations'> <?php echo $informationsPersonne->getNom() ?></td>
		</tr>
		<tr>
			<td class='labelTableauDesInformations'> Prénom: </td>
			<td class='varTableauDesInformations'> <?php echo $informationsPersonne->getPrenom() ?></td>
		</tr>
		<tr>
			<td class='labelTableauDesInformations'> Adresse email actuelle: </td>
			<td class='varTableauDesInformations'> <?php if($informationsPersonne->getEmail() == null){ echo "Aucun email renseigné"; } else { echo $informationsPersonne->getEmail(); } ?></td>
		</tr>
		<tr>
			<td class='labelTableauDesInformations'> Numéro de téléphone: </td>
			<td class='varTableauDesInformations'> <?php if($informationsPersonne->getTel() == null){ echo "Aucun numéro renseigné"; } else { echo $informationsPersonne->getTel(); } ?></td>
		</tr>
	</table>
<?php } ?>
</article>
<?php require_once('./Vue/Footer.php'); ?>