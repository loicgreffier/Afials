<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueSujets".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueSujetsBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='sujettopic'>
	<?php if(!empty($this->tableauErreurs)){
			echo "<script>
					window.onload=function(){gererAffichageProfondeur('ajouterSujet','blanket');}
				  </script>";
		  }
		  
		if(isset($nomForum, $idForum)){ 
			echo "<h1 class='nomForum'>".$nomForum."</h1>";  
			echo "<div id='blanket' style='display:none'></div>
				  <div id='ajouterSujet' style='display:none'>
					<a class='fermer' href='#' onclick=\"gererAffichageProfondeur('ajouterSujet','blanket')\"><img src='./Vue/Images/Icones/fermer.png'></img></a>
					<form id='formulaireAjoutSujet' method='post' action='./index.php'>
						<input type='hidden' name='action' value='AjouterSujet'>
						<input type='hidden' name='idForum' value='". $idForum."'>
						<input type='hidden' name='nomForum' value='".$nomForum."'>
						<table id='tableauAjoutSujet'>
							<tr><td id='titreAjoutSujet'><label>Ajouter un nouveau sujet</label></td></tr>";				
							if(isset($this->tableauErreurs)){
								for($i = 0; $i < count($this->tableauErreurs); $i++){
									echo "<tr class='messageErreurAjoutSujet'><td><label>".$this->tableauErreurs[$i]."</label></td></tr>";
								}
							}
					  echo "<tr><td><label>Sujet</label></td></tr>
							<tr><td><input id='champTitreSujet' maxlength='100' type='text' name='titreSujet'></input></td></tr>
							<tr><td><label>Message</label></td></tr>
							<tr><td><textarea maxlength='2000' name='messageSujet'></textarea></td></tr>
							<tr><td><input id='BouttonAjouterSujet' type='submit' value='Ajouter'></input></td></tr>
						</table>
					</form>
				 </div>";
	?>
	<?php
			echo "<ul class='fonctions'>
					<li><a title='Ajouter un nouveau sujet' href='#' onclick=\"gererAffichageProfondeur('ajouterSujet','blanket')\">Nouveau sujet</a></li>
					<li><a title='Afficher les nouveaux sujets' href='./index.php?action=ConsulterForum&idForum=".$idForum."&nomForum=".urlencode($nomForum)."'>Actualiser</a></li>
					<li><a title='Retourner à la page des forums' href='./index.php?action=ConsulterPageForum'>Retour page forums</a></li>
				 </ul>";
	?>
	<?php
			if(isset($listeSujets)){
				echo "<table id='tableauSujets'>
						<tr id='enteteTableauSujets'>
							<td id='sujet'>Sujet</td>
							<td id='auteur'>Auteur</td>
							<td>Réponses</td>
							<td id='dernierMessage'>Dernier message</td>
						</tr>";
					foreach($listeSujets as $sujet){
						echo "<tr class='valeurTableauSujets'>
								<td>
									<a class='nomSujet' href='./index.php?action=ConsulterSujet&idSujet=".$sujet->getIdSujet()."&nomSujet=".urlencode($sujet->getTitreSujet())."&idForum=".$idForum."&nomForum=".urlencode($nomForum)."&pageCouranteForum=".$pageCourante."'>".$sujet->getTitreSujet()."</a>";
									if(isset($roleEnseignant))
										echo "<a title='supprimer ce sujet' onclick=\"return confirm('Voulez-vous supprimer ce sujet ?');\" href='./index.php?action=SupprimerSujet&idSujet=".$sujet->getIdSujet()."&nomForum=".urlencode($nomForum)."&idForum=".$idForum."' onclick=\"return confirm('Voulez-vous vraiment supprimer ce sujet ?');\">
												<img src='./Vue/Images/Icones/supprimer.png'></img>
											</a>";
								echo "</td>
								<td>".$sujet->getAuteurSujet()."</td>
								<td>".$sujet->getNbReponses()."</td>
								<td>".$sujet->getDateDernierMessage()."</td>
							 </tr>";
					}
				echo "</table>";
			} else { echo "<h3 id='noSujets'>Ce forum ne comporte pas de sujets</h3>"; }
			
			$nbdepages = ceil($nbSujets/3);
			echo "<div class='numerosPage'>";
				for ($i = 1; $i <= $nbdepages; $i++){				
				echo "<a class='numeroPage' href='./index.php?action=ConsulterForum&idForum=".$forum->getIdForum()."&nomForum=".urlencode($forum->getIntitule())."&pageCourante=".$i."'>".$i."</a>";	
			}
			echo "</div>";
		}
	?>
</article>
<?php require_once('./Vue/Footer.php'); ?>