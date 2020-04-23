// Utilisation de l'Ajax pour appeler l'API et récuperer les enregistrements
var contenu = document.getElementById("contenu");
var enregs; // contient la reponse de l'API
// on définit une requete
const req = new XMLHttpRequest();
//on vérifie les changements d'états de la requête
req.onreadystatechange = function (event) {
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            // la requete a abouti et a fournit une reponse
            //on décode la réponse, pour obtenir un objet
            reponse = JSON.parse(this.responseText);
            console.log(this.responseText);
            console.log(reponse);
            //met dans enregs tous ce qui a dans records
            enregs = reponse.records;
            for (let i = 0; i < enregs.length; i++) {
                /*############################ 1 ere div ######################################*/
                ligne = document.createElement("div");// on crée la ligne et les div internes
                ligne.setAttribute("class", "ligne pointable");//on met un attribut
                ligne.id = i; // on met un id
                /*############################ 2 eme div ######################################*/
                ville = document.createElement("div");
                ville.setAttribute("class", "ville");            
                ligne.appendChild(ville); // met ville a la fin de la div ligne
                /*############################ 3 eme div ######################################*/   
                libelle = document.createElement("div");
                libelle.setAttribute("class", "libelle");
                ligne.appendChild(libelle);
                /*############################ 4 eme div ######################################*/                
                etat = document.createElement("div");
                etat.setAttribute("class", "etat");
                ligne.appendChild(etat);
                /*############################ 5 eme div ######################################*/
                contenu.appendChild(ligne);
                espace = document.createElement("div");
                espace.setAttribute("class","espaceHorizon");
                contenu.appendChild(espace);
                //on met à jour le contenu
                /*on prend les infos qu'on veux dans fields */
                ville.innerHTML = enregs[i].fields.commune;
                libelle.innerHTML = enregs[i].fields.nom;
                etat.innerHTML = enregs[i].fields.etat;

                // on ajoute un evenement sur ligne pour afficher le detail
                ligne.addEventListener("click", afficheDetail);
            }
            console.log("Réponse reçue: %s", this.responseText);
        } else {
            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
        }
    }
};
function afficheDetail(e) {
    velib = (e.target).parentNode; // ou que l'on clic on recupere le parent (ligne)
    velib.removeEventListener("click", afficheDetail);//apres clic on suprime l'event pour emplecher de creer des lignes identiques
    /*############################ 1 ere div ######################################*/
    detail = document.createElement("div");
    detail.setAttribute("class", "detail");
    /*############################ 2 eme div ######################################*/
    adresse = document.createElement("div");
    adresse.setAttribute("class", "adresse");
    detail.appendChild(adresse);
    /*############################ 3 eme div ######################################*/
    dispo = document.createElement("div");
    dispo.setAttribute("class", "nbPlace");
    detail.appendChild(dispo);
    /*############################ 4 eme div ######################################*/
    nbMax = document.createElement("div");
    nbMax.setAttribute("class", "nbVelo");
    detail.appendChild(nbMax);
    /**ce que l'on ajoute */
    adresse.innerHTML = enregs[velib.id].fields.adresse;
    dispo.innerHTML = "  nb de place dispo " + enregs[velib.id].fields.nbplacesdispo;
    nbMax.innerHTML= "  nb de velo dispo " + enregs[velib.id].fields.nbvelosdispo;
    //ajouter detail avant l element qui suit celui du clic
    contenu.insertBefore(detail, velib.nextSibling);
}
//on envoi la requête
req.open('GET', 'https://opendata.lillemetropole.fr/api/records/1.0/search/?dataset=vlille-realtime&rows=20&facet=libelle&facet=nom&facet=commune&facet=etat&facet=type&facet=etatconnexion', true);
req.send(null);