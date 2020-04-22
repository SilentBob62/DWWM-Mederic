// on recupere les input et on declenche les evenements pour faire les controles
var lesInputs = document.getElementsByTagName('input');
for (i = 0; i < lesInputs.length; i++)
    lesInputs[i].addEventListener("input", verif);

function verif(event) {
    // permet de controller la validité d'un champ du formulaire
    // on recupere l'input sur lequel faire la verification
    var monInput = event.target;
    //on recupere les elements correspondant à l'input
    var imgVerte = (monInput.parentNode).getElementsByClassName("boutonVert")[0];
    var imgRouge = (monInput.parentNode).getElementsByClassName("boutonRouge")[0];
    var message = (monInput.parentNode).getElementsByClassName('message')[0];

    if (monInput.value == '') {
        // si le champ est vide, on affiche rien
        imgRouge.style.visibility = 'hidden';
        imgVerte.style.visibility = 'hidden';
        message.innerHTML = "champ manquant";
    } else if (!monInput.checkValidity()) {
        // force le test du pattern sur l'input
        imgRouge.style.visibility = 'visible';
        imgVerte.style.visibility = 'hidden';
        message.innerHTML = "Format incorrect";
    } else //if (monInput.checkValidity())
    {
        imgVerte.style.visibility = 'visible';
        imgRouge.style.visibility = 'hidden';
        message.innerHTML = "";
    }
}