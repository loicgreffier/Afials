<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueMessages".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueMessagesBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>		

<article id='message'>
	<?php 
		if(!empty($this->tableauErreurs)){
			echo "<script>
					window.onload=function(){gererAffichage('ajoutMessage');}
				  </script>";
		  }
		if(isset($nomSujet, $idSujet)){
			echo "<h1 class='nomSujet'>".$nomSujet."</h1>"; 
			echo "<div id='divRetourListeSujets'>
					<a href='./index.php?action=ConsulterForum&idForum=".$idForumDuSujet."&nomForum=".urlencode($nomForumDuSujet)."&pageCourante=".$pageCouranteDuForumDuSujet."'>Retour liste des sujets</a>
				</div>";
			if(isset($listeMessages)){
				foreach($listeMessages as $message){
					echo "<div class='informationsMessage'>
							<div class='pseudo'><p>".$message->getLoginPersonne()."</p></div>
							<div class='horaire'><p>".$message->getDate()."</p></div>
							<div class='nbAvisFavorable'>
								<img src='./Vue/Images/Icones/like.png'></img>
								<p>".$message->getNbAvisFavorable()."</p>
							</div>";
							if(isset($roleEnseignant)){
								echo "<div class='iconeSupprimerMessage'>
										<a title='supprimer ce message' onclick=\"return confirm('Voulez-vous supprimer ce message ?');\" href='./index.php?action=SupprimerMessage&idMessage=".$message->getIdMessage()."&idSujet=".$idSujet."&nomSujet=".urlencode($nomSujet)."&idForum=".$idForumDuSujet."&nomForum=".$nomForumDuSujet."&pageCouranteForum=".$pageCouranteDuForumDuSujet."' onclick=\"return confirm('Voulez-vous vraiment supprimer ce forum ?');\">
											<img src='./Vue/Images/Icones/supprimer.png'></img>
										</a>
									</div>";
							}
						 echo "</div>
						 <div class='message'>
							<p>".$message->getMessage()."</p>
						 </div>";
				}
			} else { echo "<h3>Il n'y a aucun message pour ce sujet</h3>"; }
			
			echo "<div id='repondre'>
					<a href='#' onclick=\"gererAffichage('ajoutMessage')\">Répondre</a>
				</div>
				<div style='display:none;' id='ajoutMessage'>";
				echo "<form id='formulaireAjoutMessage' method='post' action='./index.php'>
						<input type='hidden' name='action' value='AjouterMessage'/>
						<input type='hidden' name='idSujet' value='".$idSujet."'/>
						<input type='hidden' name='nomSujet' value='".$nomSujet."'/>
						<input type='hidden' name='idForum' value='".$idForumDuSujet."'/>
						<input type='hidden' name='nomForum' value='".$nomForumDuSujet."'/>
						<input type='hidden' name='pageCouranteForum' value='".$pageCouranteDuForumDuSujet."'/>
						<table id='tableauAjoutMessage'>";
							if(isset($this->tableauErreurs)){
								for($i = 0; $i < count($this->tableauErreurs); $i++)
									echo "<tr class='messageErreurAjoutMessage'><td><label>".$this->tableauErreurs[$i]."</label></td></tr>";
							}
						echo "<tr><td><label>Message</label></td></tr>
							<tr><td><textarea maxlength='2000' name='message'></textarea></td></tr>
							<tr><td><input id='bouttonValiderAjoutMessage' type='submit' value='Ajouter'></input></td></tr>
						</table>
					</form>
				  </div>";
		}
	?>
</article>
<?php require_once('./Vue/Footer.php'); ?>