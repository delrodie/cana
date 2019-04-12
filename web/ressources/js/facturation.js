/**
 * Test de l'existence de la valeur
 * si valeur est supérieure ou egale a 0 alors garder la valeur
 * sinon affecter la valeur 0
 */
function existence(number) {
    if (number > 0){ return number; }
    else { return 0; }
}

// Calcul du montant entre
function calculMontantHT(odroit = null, ogauche = null, montureMontant = null) {
    if (odroit){ droit = existence(odroit);} else {droit = 0;}
    if (ogauche){ gauche = existence(ogauche); } else{ gauche = 0}
    if (montureMontant){ monture = existence(montureMontant); } else { monture = 0; }

    return droit + gauche + monture;

    //return ;
}

// Calcul du net a payer 
function calculNAP(montantHT = null, remise = null) {
    if (!montantHT){ montantHT = 0;}
    var resultat = montantHT - remise;
    return resultat;
}

// Calcul du reste a payer
function calculRAP(nap = null, assurance = null, acompte = null){
    var resultat = nap - assurance - acompte;

    return resultat;
}

// Traitement du formulaire selon le montant des verres de l'oeil droit
function odroit(){
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','.').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    if (!remise){ remise = 0; }

    if (!isNaN(odroit)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));

    }else{
        alert("Le montant du verre droit saisi est incorrect. Mettez uniquement des chiffres")
    }
}

// Traitement du formulaire selon le montant des verres de l'oeil gauche
function ogauche(){
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','.').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    if (!remise){ remise = 0; }

    if (!isNaN(ogauche)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));

    }else{
        alert("Le montant du verre gauche saisi est incorrect. Mettez uniquement des chiffres")
    }
}

// traitement du formulaire selon le montant de la monture
function montureprix(){
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    if (!remise){ remise = 0; }

    if (!isNaN(montureMontant)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));

    }else{
        alert("Le montant de la monture saisi est incorrect. Mettez uniquement des chiffres")
    }
}

// Traitement du formulaire selon la remise
function remise() {
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    if (!remise){ remise = 0; }

    if (!isNaN(remise)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));

    }else{
        alert("La remise saisie est incorrecte. Mettez uniquement des chiffres sans %")
    }
}

// Traitement du formulaire selon la part assurance
function assurance(){
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','').replace('.',''));
    var assurance = parseFloat(document.getElementById("facturation").elements["appbundle_facture_partAssurance"].value.replace(' ','').replace('.',''));
    var accompte = parseFloat(document.getElementById("facturation").elements["appbundle_facture_acompte"].value.replace(' ','').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    var nap = calculNAP(montantHT, remise);
    if (!remise){ remise = 0; }

    if (!isNaN(assurance)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));
        document.getElementById("facturation").elements["appbundle_facture_rap"].value = new Intl.NumberFormat("ci-CI").format(calculRAP(nap, existence(assurance), existence(accompte)));
        document.getElementById("facturation").elements["mtHT"].value = montantHT;
        document.getElementById("facturation").elements["mtTTC"].value = nap;
        document.getElementById("facturation").elements["RAP"].value = calculRAP(nap, existence(assurance), existence(accompte));
        document.getElementById("facturation").elements["Assurance"].value = existence(assurance);
        document.getElementById("facturation").elements["Accompte"].value = existence(accompte);

    }else{
        alert("La remise saisie est incorrecte. Mettez uniquement des chiffres sans %")
    }
}

// Traitement du formulaire selon l'acompte
function acompte() {
    var odroit = parseFloat(document.getElementById("facturation").elements["appbundle_facture_odMontant"].value.replace(' ','').replace('.',''));
    var ogauche = parseFloat(document.getElementById("facturation").elements["appbundle_facture_ogMontant"].value.replace(' ','').replace('.',''));
    var montureMontant = parseFloat(document.getElementById("facturation").elements["appbundle_facture_monturePrix"].value.replace(' ','').replace('.',''));
    var assurance = parseFloat(document.getElementById("facturation").elements["appbundle_facture_partAssurance"].value.replace(' ','').replace('.',''));
    var accompte = parseFloat(document.getElementById("facturation").elements["appbundle_facture_acompte"].value.replace(' ','').replace('.',''));
    var remise = parseFloat(document.getElementById("facturation").elements["appbundle_facture_remise"].value.replace('%',''));

    // Calcul du montant hors taxe
    // test d'existence de la remise
    var montantHT = calculMontantHT(odroit, ogauche, montureMontant);
    var nap = calculNAP(montantHT, remise);
    if (!remise){ remise = 0; }

    if (!isNaN(accompte)) {
        document.getElementById("facturation").elements["appbundle_facture_montantHT"].value = new Intl.NumberFormat("ci-CI").format(montantHT);
        document.getElementById("facturation").elements["appbundle_facture_remise"].value = existence(remise);
        document.getElementById("facturation").elements["appbundle_facture_montantTTC"].value = new Intl.NumberFormat("ci-CI").format(calculNAP(montantHT, remise));
        document.getElementById("facturation").elements["appbundle_facture_rap"].value = new Intl.NumberFormat("ci-CI").format(calculRAP(nap, existence(assurance), existence(accompte)));
        document.getElementById("facturation").elements["mtHT"].value = montantHT;
        document.getElementById("facturation").elements["mtTTC"].value = nap;
        document.getElementById("facturation").elements["RAP"].value = calculRAP(nap, existence(assurance), existence(accompte));
        document.getElementById("facturation").elements["Assurance"].value = existence(assurance);
        document.getElementById("facturation").elements["Accompte"].value = existence(accompte);

    }else{
        alert("Le montant de l'acompte saisi est incorrect. Mettez uniquement des chiffres")
    }
}
