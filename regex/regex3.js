inputs=document.getElementsByClassName("input");

for (i=0;i<inputs.length;i++){
    addEventListener("input",verif);
}
oeil=document.getElementById("oeil");
oeil.addEventListener("mousedown",montrerMDP);
oeil.addEventListener("mouseup",montrerMDP);
/** liste des fonctions*/
function verif(e){
    var monInput=e.target;
    message=(monInput.parentNode).getElementsByClassName("message")[0];
    if (monInput.value==""){
        monInput.style.border="2px solid red";
        message.style.transitionDuration = "2s";
        message.innerHTML="champ manquant";
        message.style.color="rgb(121, 8, 8)";
        message.style.border="black 1px solid";
        message.style.background="rgb(245, 119, 119)";
        message.style.borderRadius="15px";
    }
    else if (!monInput.checkValidity()){
        monInput.style.border="2px solid red";
        message.style.transitionDuration = "2s";
        message.innerHTML="Format Incorect";
        message.style.color="rgb(121, 8, 8)";
        message.style.border="black 1px solid";
        message.style.background="rgb(245, 119, 119)";
        message.style.borderRadius="15px";
    }
    else{
        monInput.style.border="2px solid rgb(100, 207, 0)";
        message.style.transitionDuration = "2s";
        message.innerHTML="correct";
        message.style.color="rgb(10, 70, 10)";
        message.style.border="black 1px solid";
        message.style.background="rgb(149, 228, 149)";
        message.style.borderRadius="15px";
    }
}
function montrerMDP(){
    if (document.getElementById('mdp').type=='text'){
        document.getElementById('mdp').type='password';
    }
    else{
        document.getElementById('mdp').type='text';
    }  
}
function verifForm(){

}
