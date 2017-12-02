function gererAffichage(div) {
	
	var element = document.getElementById(div);
	if ( element.style.display == 'none' ) { element.style.display = 'block';}
	else {element.style.display = 'none';}
}

function gererAffichageProfondeur(div, blanket){
	gererAffichage(blanket);
	gererAffichage(div);
}

function changerCouleurAgenda(dateDebut, dateFin, nomFormation, nomCentre, villeCentre, salle){
	document.getElementById(dateDebut).style.color = '#9797FF';
	document.getElementById(dateFin).style.color = '#9797FF';
	document.getElementById(nomFormation).style.color = '#9797FF';
	document.getElementById(nomCentre).style.color = '#9797FF';
	document.getElementById(villeCentre).style.color = '#9797FF';
	document.getElementById(salle).style.color = '#9797FF';
}

function gererModificationCentre(div, blanket, hiddenIdCentre, inputNomCentre, inputVilleCentre, inputRueCentre, inputCpCentre, idCentre, nomCentre, villeCentre, rueCentre, codePostal){
			
	gererAffichage(div);
	gererAffichage(blanket);
	document.getElementById(hiddenIdCentre).value = idCentre;
	document.getElementById(inputNomCentre).value = nomCentre;
	document.getElementById(inputVilleCentre).value = villeCentre;
	document.getElementById(inputRueCentre).value = rueCentre;
	document.getElementById(inputCpCentre).value = codePostal;
}

function modifierFormation(div, blanket, inputNomFormation, inputDescriptionFormation, hiddenIdFormation, idFormation, nomFormation, descriptionFormation){
	
	gererAffichage(div);
	gererAffichage(blanket);
	document.getElementById(inputNomFormation).value = nomFormation;
	document.getElementById(inputDescriptionFormation).value = descriptionFormation;
	document.getElementById(hiddenIdFormation).value = idFormation;
}

function gestionEvaluationEtoile(note, idEtoileUne, idEtoileDeux, idEtoileTrois, idEtoileQuatre, idEtoileCinq, couleur){
	
	etoileUne = document.getElementById(idEtoileUne);
	etoileDeux = document.getElementById(idEtoileDeux);
	etoileTrois = document.getElementById(idEtoileTrois);
	etoileQuatre = document.getElementById(idEtoileQuatre);
	etoileCinq = document.getElementById(idEtoileCinq);

	switch(note){
		case 1: 
				etoileUne.style.color = couleur;
				etoileDeux.style.color = "#B8B8B8";
				etoileTrois.style.color = "#B8B8B8";
				etoileQuatre.style.color = "#B8B8B8";
				etoileCinq.style.color = "#B8B8B8";
				break;
		case 2: 
				etoileUne.style.color = couleur;
				etoileDeux.style.color = couleur;
				etoileTrois.style.color = "#B8B8B8";
				etoileQuatre.style.color = "#B8B8B8";
				etoileCinq.style.color = "#B8B8B8";
				break;
		case 3:
				etoileUne.style.color = couleur;
				etoileDeux.style.color = couleur;
				etoileTrois.style.color = couleur;
				etoileQuatre.style.color = "#B8B8B8";
				etoileCinq.style.color = "#B8B8B8";
				break;
		case 4:
				etoileUne.style.color = couleur;
				etoileDeux.style.color = couleur;
				etoileTrois.style.color = couleur;
				etoileQuatre.style.color = couleur;
				etoileCinq.style.color = "#B8B8B8";
				break
		case 5:
				etoileUne.style.color = couleur;
				etoileDeux.style.color = couleur;
				etoileTrois.style.color = couleur;
				etoileQuatre.style.color = couleur;
				etoileCinq.style.color = couleur;
				break;
	}
} 

function ajouterNote(note, input, idEtoileUne, idEtoileDeux, idEtoileTrois, idEtoileQuatre, idEtoileCinq, couleur){
	
	document.getElementById(input).value = note;
	gestionEvaluationEtoile(note, idEtoileUne, idEtoileDeux, idEtoileTrois, idEtoileQuatre, idEtoileCinq, couleur);
}

