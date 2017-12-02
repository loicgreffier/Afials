<?php if(isset($_COOKIE['couleurSite'])){ 
		DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/Site".$_COOKIE['couleurSite']."/cssVueAccueil".$_COOKIE['couleurSite'].".css", './Vue/Images/Icones/iconePrincipale.ico'); 
	} else { DebutFichierHTML('Accueil', 'utf-8', "./Vue/Css/SiteBleu/cssVueAccueilBleu.css", './Vue/Images/Icones/iconePrincipale.ico'); }?>
<?php require_once('./Vue/Header.php'); ?>
<article id='tableauDeBord'>
	<div id='messagesDefilant'>
		<div id="scrollup">
		  <div class="headline"> Bienvenue sur Afials.fr, le nouveau site destiné aux enseignants-formateurs </div>  
		  <div class="headline"> Nous sommes le <?php echo date('d/m/Y')." il est ". date('H:i:s'); ?> </div>  
		  <div class="headline"> Admission Post Bac: plus que 5 jours avant la fin des inscriptions </div>  
		  <div class="headline"> Etudiants de 2ème année: les bulletins du deuxième semestre sont disponibles au secretariat </div> 
		  <div class="headline"> 27 Mars 2015: Portes ouvertes dans tout les IUT de l'Universite d'Auvergne </div> 	  
		</div>
	</div>
	
<?php 	if($dossier = opendir('./Vue/Images/Banniere')){
		$numImage = 1;
		echo "<div id='banniereImages'>";
		while(false !== ($fichier = readdir($dossier))){
			if($fichier != '.' && $fichier != '..'){
				echo "<img id='image".$numImage."' src='./Vue/Images/Banniere/".$fichier."'></img>";
				$numImage++;
			}
        } 
        echo "</div>";
		echo "<script type='text/javascript' src='http://code.jquery.com/jquery-1.8.2.min.js'></script>
			<script>
				var stream_tab = {
					nbSlide : 0,
					nbCurrent : 1,
					elemCurrent : null,
					elem : null,
					timer : null,

					init : function(elem){
						this.nbSlide = elem.find('img').length;
						this.elem=elem;
						elem.find('img').hide();
						elem.find('img:first').show();
						this.elemCurrent = elem.find('img:first');
						this.timer = window.setInterval('stream_tab.next()',6000);
					},

					gotoSlide : function(num){
						if(num==this.nbCurrent){return false;}
						$('#image'+(num-1)).fadeOut();
						this.elem.find('#image'+num).fadeIn();
						this.nbCurrent = num;
					},

					next : function(){
						var num = this.nbCurrent+1;
						if(num > this.nbSlide){ num = 1; }
						this.gotoSlide(num);
					},
				}

				$(function(){
					stream_tab.init($('#banniereImages'));
				});
			</script>";
		}
	?>
	<ul id='menu'>
		<?php if(isset($loginPersonneConnectee)){ echo "<li id='bonjourPersonne' >Bonjour ".$nomPersonneConnectee." ".$prenomPersonneConnectee."</li>"; } ?>
		<li id='titreMenu'>Tableau de bord</li>
		<li><a href='./index.php?action=DemanderInscription'>Demande d'inscription</a></li>
		<li><a href='http://www.u-clermont1.fr/'>Université d'Auvergne</a></li>
		<li>Couleurs du site
			<span id='listeCouleursSite'>
				<a href='./index.php?action=ChangerCouleurSite&couleur=Rouge'><div class='couleurSite' id='couleurRouge'></div></a>
				<a href='./index.php?action=ChangerCouleurSite&couleur=Bleu'><div class='couleurSite' id='couleurBleu'></div></a>
				<a href='./index.php?action=ChangerCouleurSite&couleur=Vert'><div class='couleurSite' id='couleurVert'></div></a>
			</span>
		</li>
		<li><a href='https://www.facebook.com/pages/Afials/930215026991694'>Facebook</a> / <a href='https://twitter.com/?lang=fr'>Twitter</a></li>
		<li><a href='./index.php?action=ConsulterContact'>Contact</a></li>
		<li><a href='./index.php?action=ConsulterAPropos'>À propos</a></li>
		<li><a href='./index.php?action=ConsulterMentionsLegales'>Mentions légales</a></li>
	</ul>
	<script>
		var headline_count;
		var headline_interval;
		var old_headline = 0;
		var current_headline = 0;
		$(document).ready(function(){
			headline_count = $("div.headline").size();
			$("div.headline:eq("+current_headline+")").css('top', '5px');
	 
			headline_interval = setInterval(headline_rotate,5000);
			$('#scrollup').hover(function() {
				clearInterval(headline_interval);
				}, function() {
				headline_interval = setInterval(headline_rotate,5000);
				headline_rotate();
			});
		});
		function headline_rotate() {
			current_headline = (old_headline + 1) % headline_count;
			$("div.headline:eq(" + old_headline + ")").animate({top: -205},"slow", function() {
				$(this).css('top', '210px');
			});
		   $("div.headline:eq(" + current_headline + ")").animate({top: 5},"slow");  
			old_headline = current_headline;
		}
	</script>
	<div id='Derniers forums consultés'>
	</div>
</article>

<?php require_once('./Vue/Footer.php'); ?>
