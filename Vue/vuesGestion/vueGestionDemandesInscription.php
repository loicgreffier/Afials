<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueGestionDemandesInscription".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueGestionDemandesInscriptionBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>

<article id='demandesInscription'>
	<p id='titreDemande'> Demandes d'inscription </p>
	<?php if(isset($inscriptions)){ ?>
			<table id='tableauDemande'>
				<tr>
					<td id='nom' class='labelDemande'> Nom </td>
					<td id='prenom' class='labelDemande'> Prénom </td>
					<td id='email' class='labelDemande'> Email </td>
					<td id='telephone' class='labelDemande'> Téléphone </td>
				</tr>
			<?php foreach($inscriptions as $i){
				echo "<tr>
						<td class='varDemande'>". $i->getNom(). "</td>
						<td class='varDemande'>". $i->getPrenom(). "</td>
						<td class='varDemande'>". $i->getEmail(). "</td>
						<td class='varDemande'>". $i->getTel(). "</td>
						<td>
							<a onclick=\"return confirm('Voulez-vous vraiment répondre favorablement à la demande de cette personne ? Elle disposera de tous les droits d\'un enseignant-formateur');\" href='./index.php?action=ValiderDemandeInscription&loginPersonne=".$i->getLogin()."'>
								<img src='./Vue/Images/Icones/valider.png' title='Ajouter cette personne'/></a></td>
						<td>
							<a onclick=\"return confirm('Voulez-vous vraiment décliner la réponse de cette personne ?');\" href='./index.php?action=DeclinerDemandeInscription&loginPersonne=".$i->getLogin()."'>
								<img src='./Vue/Images/Icones/supprimer.png' title='Refuser cette personne'/></a></td>
					</tr>";
			}
		} else { echo "<p id='noDemande'> Vous n'avez aucune demande </p>"; }
	?>
	</table>
</article>
<?php require_once('./Vue/Footer.php'); ?>