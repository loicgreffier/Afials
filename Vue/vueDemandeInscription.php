<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueDemandeInscription".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueDemandeInscriptionBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='demandeInscription'>
<p id='annonceInscription'> Vous êtes enseignant ou formateur ? Vous souhaitez rejoindre Afials.fr ? </br>
Faites une demande d'inscription dès maintenant en renseignant les quelques informations demandées ! </br> Simple et rapide, votre demande sera traitée au plus vite par un de nos administrateurs. </br>
Si votre demande est validée, vos identifiants vous seront communiquer à l'email renseigné. </p>

<?php 
	if(isset($this->tableauErreurs)){
		echo "<table id='tableauErreursDemande'>";
			for($i = 0; $i < count($this->tableauErreurs); $i++)
				echo "<tr><td><label class='messageErreurDemande'>".$this->tableauErreurs[$i]."</label></td></tr>";
		echo "</table>";
	}			
?>
<?php if(isset($ajouter)){ echo "<p id='demandeenvoyee'> Votre demande a bien été envoyée et sera traitée dès que possible </p>"; } ?>	
<form id='formulaireDemandeInscription' method='POST' action='./index.php'>
	<input type='hidden' name='action' value='EnvoyerDemandeInscription'/>
	<table class='demanderInscription'>
		<tr><td><label class='titreInscription'>Informations personnelles</label></td></tr>
		<tr><td><label>Nom</label></td></tr>
		<tr><td><input type='text' name='nomDemandeur'></input></td></tr>
		<tr><td><label>Prénom</label></td></tr>
		<tr><td><input type='text' name='prenomDemandeur'></input></td></tr>
		<tr><td><label>Email</label></td></tr>
		<tr><td><input type='text' name='emailDemandeur'></input></td></tr>
		<tr><td><label>Téléphone <i>(0011223344)</i></label></td></tr>
		<tr><td><input type='text' name='telDemandeur'></input></td></tr>
		<tr><td id='bouttonSoumission'><input type='submit' value='Envoyer la demande'></input></td></tr>
	</table>
</form>
</article>
<?php require_once('./Vue/Footer.php'); ?>