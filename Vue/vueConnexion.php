<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueConnexion".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueConnexionBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='connexion'>
	<?php 
		if(isset($this->tableauErreurs)){
			echo "<table id='tableauErreursConnexion'>";
				for($i = 0; $i < count($this->tableauErreurs); $i++)
					echo "<tr><td><label class='messageErreurConnexion'>".$this->tableauErreurs[$i]."</label></td></tr>";
			echo "</table>";
		}			
	?>

	<form id="formulaireConnexion" action="./index.php" method="post">
		<input type="hidden" name="action" value="SeConnecter"/>
		<table id='tableConnexion'>
			<tr><td><label class="label">Login</label></td></tr>
			<tr><td><input type="text" name="login"></input></td></tr>
			<tr><td><label class="label">Mot de passe</label></td></tr>
			<tr><td><input type="password" name="password"></input></td></tr>
		</table>
		<table id='tableBouttons'>
			<tr><td><input type="submit" value="Connexion"></input></td></tr>
			<tr><td><input type="button" value="Retour" onclick="history.back();"></input></td></tr>
		</table>
	</form>
</article>
<?php require_once('./Vue/Footer.php'); ?>

