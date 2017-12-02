<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVuePageForum".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVuePageForumBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='pageForum'>
	<?php if(isset($this->tableauErreurs['erreurAfficherPopup'])){ echo "<script> window.onload = function(){ gererAffichageProfondeur('".$this->tableauErreurs['erreurAfficherPopup']."','blanket9'); } </script>";  } ?>	
	<div id='blanket9' style='display:none'></div>
	<div id='ajouterForum' style='display:none'>
		<a class='fermer' href='#' onclick=gererAffichageProfondeur('ajouterForum','blanket9')><img src='./Vue/Images/Icones/fermer.png'></img></a>
		<form id='formulaireAjoutForum' method='post' action='./index.php'>
			<input type='hidden' name='action' value='AjouterForum'>
			<input type='hidden' name='idDiv' value='ajouterForum'>
			<table id='tableauAjoutForum'>
				<tr><td id='titreAjoutForum'><label>Ajouter un nouveau forum</label></td></tr>				
				<?php if(isset($this->tableauErreurs)) 
						if(in_array('ajouterForum',$this->tableauErreurs)){
							for($i = 0; $i < count($this->tableauErreurs)-1; $i++)
								echo "<tr><td><label class='messageErreurAjoutForum'>".$this->tableauErreurs[$i]."</label></td></tr>";	
						}
				?>
				<tr><td><label>Nom du forum</label></td></tr>
				<tr><td><input id='BouttonAjoutTitreForum' type='text' name='titreForum'></input></td></tr>
				<tr><td><input id='BouttonAjouterForum' type='submit' value='Ajouter'></input></td></tr>
			</table>
		</form>
	</div>
	
<h1 id='listeForums'>Liste des forums</h1>
<ul id='fonctionsForum'>
	<li><a title='Ajouter un nouveau forum' href='#' onclick=gererAffichageProfondeur('ajouterForum','blanket9')>Nouveau forum</a></li>
</ul>

<?php 	
	if(isset($listeForums)){
		echo "<table id='tableauForums'>";
		foreach($listeForums as $forum){	
			echo "<tr>
					<td>
						<a href='./index.php?action=ConsulterForum&idForum=".$forum->getIdForum()."&nomForum=".urlencode($forum->getIntitule())."'>".$forum->getIntitule()."</a>
					</td>";
					if(isset($roleEnseignant)){
						echo "<td>
								<a title='supprimer ce forum' onclick=\"return confirm('Voulez-vous supprimer ce forum ?');\" href='./index.php?action=SupprimerForum&idForum=".$forum->getIdForum()."'>
									<img src='./Vue/Images/Icones/supprimer.png'></img>
								</a>
							</td>";
					}
				echo "</tr>"; 
			}
		echo "</table>";
	} 
	?>
</article>
<?php require_once('./Vue/Footer.php'); ?>