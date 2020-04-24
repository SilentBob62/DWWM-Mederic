var comboRegion = document.getElementById("region");
comboRegion.addEventListener("change",function () { changeRegion();});
function changeRegion(){
    var idReg = comboRegion.selectedOptions[0].value;
    // on définit une requete
    const req = new XMLHttpRequest();
    //on vérifie les changements d'états de la requête
    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                // la requete a abouti et a fournit une reponse
                console.log("Réponse reçue: %s", this.responseText);
                //on décode la réponse, pour obtenir un objet
                reponse = JSON.parse(this.responseText);
                console.log(reponse);
                // on localise, l'endroit où afficher la réponse
                var selectDepart  = document.getElementById("departement");
                //on vide les anciens elements
                nbEntree = selectDepart.length;
                for (let i=0;i<nbEntree;i++) 
                selectDepart.remove(0);
                //on boucle sur la reponse
                for (let i=0;i<reponse.length;i++)
                {          
                    //on ajoute une option au select
                    var option = document.createElement("option");
                    option.text=reponse[i].libelleDepartement;
                    console.log(reponse[i].libelleDepartement);
                    selectDepart.add(option);
                }
            } else {
                console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
            }
        }
    };
    //on envoi la requête
    req.open('POST', '/DWWM-Mederic/Ajax Combobox/PHP/Model/APIDepartementList.php', true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var args = "idRegion="+idReg;
    req.send(args);
}