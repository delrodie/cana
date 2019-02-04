/**
 * Test de l'existence de la valeur
 * si valeur est supérieure ou egale a 0 alors garder la valeur
 * sinon affecter la valeur 0
 */
function existence(number) {
    if (number > 0){ return number; }
    else { return 0; }
}

/**
 * Calcul du reste a payé de la facture
 */
function calculRAP(facture = null, verse = null){
    if (!verse){
        verse = 0;
        return resultat = facture - verse;
    } else{
        return resultat = facture - existence(verse);
    }
}

// Traitetement du formulaire selon le montant versé
function verse()
{
    var facture = parseFloat(document.getElementById("versement").elements["appbundle_facture_rap"].value.replace(' ','').replace('.',''));
    var verse = parseFloat(document.getElementById("versement").elements["appbundle_versement_acompte"].value.replace(' ','').replace('.',''));

    // Calcul du montant restant a payer
    var rap = calculRAP(facture, verse);

    if (!isNaN(verse)) {
        document.getElementById("versement").elements["appbundle_versement_reste"].value = new Intl.NumberFormat("ci-CI").format(rap);
        document.getElementById("versement").elements["acompte"].value = existence(verse);
        document.getElementById("versement").elements["rap"].value = rap;
    }else{
        alert("Le montant du verre droit saisi est incorrect. Mettez uniquement des chiffres")
    }
}
