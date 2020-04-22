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
var tTime=[]; //tableau des temps intermédiaires (lap)
var nTime=0; //compteur des temps intermédiaires

function affTime(tm){ //affichage du compteur
   var vMin=tm.getMinutes();
   var vSec=tm.getSeconds();
   var vMil=Math.round((tm.getMilliseconds())/10); //arrondi au centième
   if (vMin<10){
      vMin="0"+vMin;
   }
   if (vSec<10){
      vSec="0"+vSec;
   }
   if (vMil<10){
      vMil="0"+vMil;
   }
   document.getElementById("chronometre").innerHTML=vMin+":"+vSec+":"+vMil;
}
function fChrono(){
   tmNow=new Date();
   Interv=tmNow-tmStart;
   tmInterv=new Date(Interv);
   affTime(tmInterv);
}
function startTime(){
    pauseTime();
   if (tmInterv==0) {
      tmStart=new Date();
   } else { //si on repart après un clic sur Stop
      tmNow=new Date();
      Pause=tmNow-tmInterv;
      tmStart=new Date(Pause);
   }
   setTm=setInterval(fChrono,10); //lancement du chrono tous les centièmes de secondes
}

function pauseTime(){
   clearInterval(setTm);
   tTime[nTime]=tmInterv;
}

function stopTime(){ //on efface tout
    pauseTime();
   tmStart=0;
   tmInterv=0;
   tTime=[];
   nTime=0;
   document.getElementById("chronometre").innerHTML="00:00:00";
}