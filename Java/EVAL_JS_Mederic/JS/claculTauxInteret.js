/**recupere tous les inputs */
inputs=document.getElementsByTagName("input");
boutonZero=document.getElementById("zero");
boutonCalcul=document.getElementById("calcul");


/**action verification pour chaque input */
for (i=0;i<inputs.length;i++){
    addEventListener("input",verif);
}
boutonCalcul.addEventListener("click", function(){
    calcul();
});
boutonZero.addEventListener("click",function(){
    reInit();
});

/** liste des fonctions*/
/**verification */
function verif(e){
    var monInput=e.target;
    message=(monInput.parentNode).getElementsByClassName("message")[0];
    if (monInput.value==""){
        monInput.style.border="2px solid red";
        message.style.transitionDuration = "2s";
        message.innerHTML="champ manquant";
        message.style.color="rgb(255, 0, 0)";
    }
    else if (!monInput.checkValidity()){
        monInput.style.border="2px solid red";
        message.style.transitionDuration = "2s";
        message.innerHTML="Format Incorect";
        message.style.color="rgb(255, 0, 0)";
    }
    else{
        monInput.style.border="2px solid rgb(100, 207, 0)";
        message.style.transitionDuration = "2s";
        message.innerHTML="correct";
        message.style.color="rgb(100, 207, 0)";
    }
}
function reInit(){
    messages=document.getElementsByClassName("message");
    for (i=0;i<inputs.length;i++){
    inputs[i].value="" ;
    inputs[i].style.border="";
    messages[i].innerHTML="";
    }
}
function calcul(){
    capital=document.getElementById("emprunt").value;
    taux=document.getElementById("taux").value;
    nbMois=document.getElementById("duree").value*12;
    Mensulalite = (capital * taux/12)/(1 - Math.pow(1 + taux/12, -nbMois));
    document.getElementById("mensualite").value=Mensulalite;
    cout=Mensulalite*nbMois;
    document.getElementById("cout").value=cout;
}