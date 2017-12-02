<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueNotesEleve".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueNotesEleveBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='mesNotes'>
	<div id='parametresEleves'>
		<ul>	
			<li id='titreEleves'> Mes notes </li>
		</ul>
	</div>
	<section id='mesFormationsEvaluees'>
		<h1 id='titreMesFormationsEvaluees'> Formations evaluées </h1>
			<?php if(isset($listeFormationsEvalueesEleve)){
					echo "<table id='tableauMesFormationsEvaluees'>";
					foreach($listeFormationsEvalueesEleve as $formation){
						echo "<tr>
								<td class='nomMesFormationEvaluee'>
									<a href='./index.php?action=ConsulterMesNotes&idFormation=".$formation->getIdFormation()."&nomFormation=".urlencode($formation->getNomFormation())."'>".$formation->getNomFormation()."</a>
								</td>
							</tr>";
					}
					echo "</table>";
					$nbPages = ceil($nbFormationsEvaluees/20);
					if($nbPages > 1){
						echo "<div class='nbPages'>";
						for ($i = 1; $i <= $nbPages; $i++) 
							echo "<a href='./index.php?action=ConsulerMesNotes&pageCouranteFormation=".$i."&idFormation=".$formation->getIdFormation()."&nomFormation=".urlencode($formation->getNomFormation())."'>".$i."</a>";	
						echo "</div>";	
					}
				} else { echo "<p id='noMesFormationEvaluee'> Vous n'avez aucune formation evaluée </p>"; }
			?>
	</section>
	<section id='listeMesDevoirs'>
		<h1 id='titreMesDevoirs'> Récapitulatif des notes de "<span class='coloration'><?php echo $nomFormation ?></span>"</h1>
		<table>
			<tr>
				<td id='nomDevoirMesNotes' class='enteteMesNotes'> Nom du devoir </td>
				<td id='dateDevoirMesNotes' class='enteteMesNotes'> Date </td>
				<td id='noteDevoirMesNotes' class='enteteMesNotes'> Note </td>
				<td id='coeffDevoirMesNotes' class='enteteMesNotes'> Coefficient </td>
			</tr>
		<?php if(isset($tableauDevoirsNotes)){ 
				foreach($tableauDevoirsNotes['devoir'] as $devoir){
					echo "<tr>
							<td class='enteteMesNotes'>". $devoir->getNomDevoir() ."</td>
							<td class='enteteMesNotes'>". $devoir->getDate() ."</td>
							<td class='enteteMesNotes'>". $tableauDevoirsNotes['note'][$devoir->getIdDevoir()]->getNote()."/".$devoir->getNoteMax()."</td>
							<td class='enteteMesNotes'>". $devoir->getCoefficient() ."</td>
						</tr>";
				}
				echo "<tr><td class='moyenneFormation' colspan=4> Moyenne dans cette matière: <span class='coloration'>". $moyenne ."/20</span></td></tr>";
			}
		?>
		</table>
	</section>
</article>
<?php require_once('./Vue/Footer.php'); ?>