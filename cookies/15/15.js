boutonStart=document.getElementsByTagName("button")[0];
boutonPause=document.getElementsByTagName("button")[1];
boutonStop=document.getElementsByTagName("button")[2];

boutonStart.addEventListener("click",startTime);
boutonPause.addEventListener("click",pauseTime);
boutonStop.addEventListener("click",stopTime);

var setTm=0;
var tmStart=0;
var tmNow=0;
var tmInterv=0;

function afficheTime(tm){ //affichage du compteur
   var vMin=tm.getMinutes();        //getMinutes existe deja
   var vSec=tm.getSeconds();        //getSeconds existe deja
   var vMil=Math.round((tm.getMilliseconds())/10); //arrondi au centième //getMilliseconds existe deja
   if (vMin<10){       // si pas de dizaine
      vMin="0"+vMin; //affiche le 0 dans les disaines
   }
   if (vSec<10){
      vSec="0"+vSec; //affiche le 0 dans les disaines
   }
   if (vMil<10){
      vMil="0"+vMil; //affiche le 0 dans les disaines
   }
   document.getElementById("chronometre").innerHTML=vMin+":"+vSec+":"+vMil; // affiche le temps
}
function chrono(){
   tmNow=new Date();
   Interv=tmNow-tmStart;
   tmInterv=new Date(Interv);
   afficheTime(tmInterv);
}
function startTime(){
    pauseTime();
   if (tmInterv==0) {
      tmStart=new Date();
   } else { //si on repart après un clic sur pause
      tmNow=new Date();
      Pause=tmNow-tmInterv;
      tmStart=new Date(Pause);
   }
   setTm=setInterval(chrono,10); //lancement du chrono tous les centièmes de secondes
}

function pauseTime(){
   clearInterval(setTm);    // interval passe a 0 le chrono n'avance plus
}

function stopTime(){ //on efface tout
    pauseTime();
   tmStart=0;
   tmInterv=0;
   document.getElementById("chronometre").innerHTML="00:00:00";
}