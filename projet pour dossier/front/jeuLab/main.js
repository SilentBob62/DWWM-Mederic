/* 
Idées d'améliorations :
 - système de score selon le temps et le nb d'obstacles touchés
*/

// ====================================================================================================== Affichage et ambiance du jeu

// ===> bouton : règles

// document.getElementById("rules").addEventListener("click", function () {
//     alert("Les contrôles sont les suivants :\n- 8 : haut\n- 6 : droite\n- 2 : bas\n- 4 : gauche\n\nMais aussi :\n- 7 : haut gauche\n- 9 : haut droite\n- 3 : bas droite\n- 1 : bas gauche")
// });

// document.getElementById("game").addEventListener("click", function () {
//     alert("Le but du jeu est de se déplacer (vous êtes le cube rose) vers l'arrivée (qui correspond au trait vert) le plus rapidement possible.\n\nQuelques règles :\n-1s si vous touchez un mur noir\n-3s si vous touchez un cube rouge\n-5s si vous touchez un cube bleu\n\nSI le compteur tombe à 0, vous avez perdu!")
// });

// // ===> bouton : play/stop music

// document.getElementById("musicOn").addEventListener("click", function () {
//     playSound("music", 0.5, true)
// });

// document.getElementById("musicOff").addEventListener("click", function () {
//     stopSound("music")
// });

// ===> gestion des sons

// function playSound(div, volume, loop) {
//     var audio = document.getElementById(div);
//     audio.volume = volume;

//     if (loop) {
//         audio.loop = true;
//     }

//     audio.play();
// }

// function stopSound(div) {
//     var audio = document.getElementById(div);
//     audio.pause();
// }

// ===> gestion du temps

// document.getElementById("play").addEventListener("click", startTimer);
// var sec = 80; // on détermine le compteur initial

// function startTimer() {
//     var timer = setInterval(function () { // on crée un setInterval de 1sec
//         document.getElementById('time').innerHTML = "<strong>TEMPS RESTANT</strong> : " + sec + " secondes";
//         sec--;

//         if (sec < 0) { // lorsqu'on arrive à 0
//             clearInterval(timer);
//             document.getElementById("time").innerHTML = "Temps écoulé !";
//             alert("Désolé, tu n'es pas arrivé assez vite. La partie est terminée.")
//         }
//     }, 1000);
// }

// ====================================================================================================== Fonctionnement du jeu

// ===> gestion du déplacement

function move(pX, pY) {
    var move = true;
    body=document.getElementsByTagName("body")[0];
    if(body.id=="niveau1")
    {
        var player = document.getElementById("player"); // joueur
    }
    else if (body.id=="niveau2")
    {
        var player = document.getElementById("playerNiveau2"); // joueur
    }
    var stylePlayer = window.getComputedStyle(player, null); // css du joueur
    var pT = parseInt(stylePlayer.top); // joueur position X
    var pL = parseInt(stylePlayer.left); // joueur position Y
    var pW = parseInt(stylePlayer.width); // joueur largeur
    var pH = parseInt(stylePlayer.height); // joueur hauteur

    var allObstacles = document.querySelectorAll(".obstacle"); // on liste tous les obstacles
    allObstacles.forEach(function (unObstacle) {
        var styleObstacle = window.getComputedStyle(unObstacle, null); // css de l'obstacle
        var oT = parseInt(styleObstacle.top); // obstacle position X
        var oL = parseInt(styleObstacle.left); // obstacle position Y
        var oW = parseInt(styleObstacle.width); //obstacle largeur
        var oH = parseInt(styleObstacle.height); // obstacle hauteur
        var color = styleObstacle.backgroundColor; // couleur de l'obstacle
        var id=unObstacle.id;

        move = move && collision(oT, oL, oW, oH, pT + pY, pL + pX, pW, pH, color,id);
    });

    if (move) {
        if (limit(pT + pY, pL + pX, pW)) {
            player.style.top = pT + pY + "px";
            player.style.left = pL + pX + "px";
        }
    }
}

// ===> gestion des collisions (et des différents résultats : dont la victoire)

function collision(oT, oL, oW, oH, pT, pL, pW, pH, color,id) {
    if (pL < oL + oW && pL + pW > oL && pT < oT + oH && pT + pH > oT) {
        switch (color) {
            case "rgb(54, 39, 5)":
                // si on touche la porte sans la cle
                // stopSound("music")
                alert("il me faut une clé!");
                // break;
            case "rgb(0, 0, 0)":
                // si on touche un mur
                break;
            case "rgb(255, 0, 0)":

                baton=document.getElementsByClassName("baton")[0];
                baton.setAttribute("class","invisibleBaton");
                invisibleBaton=document.getElementsByClassName("invisibleBaton");
                // setTimeout(player.style.backgroundColor="red", 1000); 
                // alert("Aie!!!");
                if (invisibleBaton.length==3) document.location.href="index.php?act=gameover";
                degat();
                
                // alert("GAME OVER!!!");
                // si on touche un obstacle rouge
                break;
            case "rgb(0, 0, 255)":
                baton=document.getElementsByClassName("baton")[0];
                baton.setAttribute("class","invisibleBaton");
                invisibleBaton=document.getElementsByClassName("invisibleBaton");
                // alert("Aie!!!");
                if (invisibleBaton.length==3) document.location.href="index.php?act=gameover";
                degat()
                // alert("GAME OVER!!!");
                // si on touche un obstacle bleu
                break;
            case "rgb(180, 25, 25)":
                redFonce = document.getElementsByClassName("redFonce")[0];
                redFonce.setAttribute("class", "invisible");
                blockRouge[0].setAttribute("class", "enfonce")
                imagePorteRouge=document.getElementById("imagePorteRouge").style.display="none";
                imageBoutonRouge=document.getElementById("imageBoutonRouge").style.display="none";
                for (i = 0; i < 6; i++)
                    blockRouge[i].style.display = "block";
                break;
            case "rgb(22, 22, 110)":
                {
                bleuFonce=document.getElementsByClassName("blueFonce")[0];
                bleuFonce.setAttribute("class","invisible");
                imagePorteBleu=document.getElementById("imagePorteBleu").style.display="none";
                imageBoutonBleu=document.getElementById("imageBoutonBleu").style.display="none";
                invisibleBleu=document.getElementsByClassName("invisibleBleu");
                square12=document.getElementsByClassName("square12")[0];
                square12.setAttribute("class", "invisible");
                invisibleBleu[0].setAttribute("class","obstacle blue square9");
                invisibleBleu[1].setAttribute("class","obstacle blue square10");
                invisibleBleu=document.getElementsByClassName("invisibleBleu");
                invisibleBleu[0].setAttribute("class","obstacle blue square11");
                var div = document.getElementsByClassName("blue");
                for(i=0;i<div.length;i++){
                    var imgBleu = document.createElement("img");
                    imgBleu.src = "image/MonstreBleu.png";
                    div[i].appendChild(imgBleu);
                }
                }
                break;
        }
        switch (id) {
            case "piece1":
                piece1=document.getElementById("piece1");
                piece1.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece2":
                piece2=document.getElementById("piece2");
                piece2.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece3":
                piece3=document.getElementById("piece3");
                piece3.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece4":
                piece4=document.getElementById("piece4");
                piece4.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece5":
                piece5=document.getElementById("piece5");
                piece5.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece6":
                piece6=document.getElementById("piece6");
                piece6.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece7":
                piece7=document.getElementById("piece7");
                piece7.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "piece8":
                piece8=document.getElementById("piece8");
                piece8.setAttribute("class","invisible");
                nombrePiece=document.getElementById("nombrePiece").innerHTML;
                nombrePiece=parseInt(nombrePiece)+1;
                document.getElementById("nombrePiece").innerHTML=nombrePiece;
            break;
            case "key1":
                key1=document.getElementById("key1");
                key1.setAttribute("class","invisible");
                rond1=document.getElementById("rond1");
                rond1.setAttribute("class","invisible");
                rondNoir1=document.getElementById("rondNoir1");
                rondNoir1.setAttribute("class","invisible");
                tige1=document.getElementById("tige1");
                tige1.setAttribute("class","invisible");
                rondInvisible=document.getElementById("rondInvisible");
                rondInvisible.setAttribute("class","rond silver");
                rondCentreInvisible=document.getElementById("rondCentreInvisible");
                rondCentreInvisible.setAttribute("class","rondCentre black");
                tigeInvisible=document.getElementById("tigeInvisible");
                tigeInvisible.setAttribute("class","tige2 silver");
                porte1=document.getElementsByClassName("porte1")[0];
                porte1.setAttribute("id","porte1");
                porte1.setAttribute("class","obstacle porte1");
            break;
            case "key2":
                key2=document.getElementById("key2");
                key2.setAttribute("class","invisible");
                rond2=document.getElementById("rond2");
                rond2.setAttribute("class","invisible");
                rondNoir2=document.getElementById("rondNoir2");
                rondNoir2.setAttribute("class","invisible");
                tige2=document.getElementById("tige2");
                tige2.setAttribute("class","invisible");
                rondInvisible=document.getElementById("rondInvisible");
                rondInvisible.setAttribute("class","rond silver");
                rondCentreInvisible=document.getElementById("rondCentreInvisible");
                rondCentreInvisible.setAttribute("class","rondCentre black");
                tigeInvisible=document.getElementById("tigeInvisible");
                tigeInvisible.setAttribute("class","tige2 silver");
                porte2=document.getElementsByClassName("porte2")[0];
                porte2.setAttribute("id","porte2");
                porte2.setAttribute("class","obstacle porte2");
            break;
            case "porte1":
                // si on touche l'arrivée, c'est gagné
                // alert("Bien joué, c'est gagné !"); 
                document.location.href="index.php?act=niveau2";
            break;  
            case "porte2":
                // si on touche l'arrivée, c'est gagné
                alert("Bien joué, c'est gagné !"); 
            break;    
        }
        // playSound("soundCollision", 1, false);
        return false;
    }
    return true;
}
//===>geestion du deplacement après degats
function degat()
{
    var speed2 = 20; // vitesse de déplacement
    var event = event || window.event, // pour la compatibilite avec tous les navigateurs
    keyCode = event.keyCode;
    switch (keyCode) {
        case 37: // gauche(100)
            move(speed2, 0);
            break;
        case 38: // haut(104)
            move(0, speed2);
            break;
        case 39: // droite(102)
            move(-speed2, 0);
            break;
            case 40: // bas(98)
            move(0, -speed2)
            break;
                    }
}

// ===> gestion des limites de l'écran

function limit(top, left, width) {
    var limitLeftTop = 0; // limite haut-gauche de la page
    var limitRight = window.innerWidth - width; // limite droite de la page
    var limitBottom = window.innerHeight - width; // limite bas de la page

    if (left < limitLeftTop || top < limitLeftTop || left > limitRight || top > limitBottom) {
        playSound("soundLimit", 1, false);
        return false;
    }
    return true;
}
//===>
function moveHorizontal()
{
    body=document.getElementsByTagName("body")[0];
    if(body.id=="niveau2")
    {
        blue=document.getElementsByClassName("blue")[0];
        blue2=document.getElementsByClassName("blue")[2];
        blue5=document.getElementsByClassName("blue")[5];
        var styleBlue = window.getComputedStyle(blue, null);
        var styleBlue2 = window.getComputedStyle(blue2, null);
        var styleBlue5 = window.getComputedStyle(blue5, null);
        var pE = parseInt(styleBlue.left);
        var pE2 = parseInt(styleBlue2.left);
        var pE5 = parseInt(styleBlue5.top);
        line21=document.getElementsByClassName("line21")[0];
        var styleLine21 = window.getComputedStyle(line21, null);
        var l21L=parseInt(styleLine21.left);
        var l21W=parseInt(styleLine21.width);
        var l21Left=l21W+l21L;
        line27=document.getElementsByClassName("line27")[0];
        var styleLine27 = window.getComputedStyle(line27, null);
        var l27L=parseInt(styleLine27.left);
        var l27W=parseInt(styleLine27.width);
        line26=document.getElementsByClassName("line26")[0];
        var styleLine26 = window.getComputedStyle(line26, null);
        var l26L=parseInt(styleLine26.left);
        var l26W=parseInt(styleLine26.width);
        var l26Left=l26W+l26L;
        line23=document.getElementsByClassName("line23")[0];
        var styleLine23 = window.getComputedStyle(line23, null);
        var l23L=parseInt(styleLine23.left);
        var l23W=parseInt(styleLine23.width);
        line22=document.getElementsByClassName("line22")[0];
        var styleLine22 = window.getComputedStyle(line22, null);
        var l22T=parseInt(styleLine22.top);
        var l22H=parseInt(styleLine22.height);
        // var l26Left=l26W+l26L;
        line37=document.getElementsByClassName("line37")[0];
        var styleLine37 = window.getComputedStyle(line37, null);
        var l37T=parseInt(styleLine37.top);
        var l37H=parseInt(styleLine37.height);
        if (pE>l21Left+5) 
        {
            blue.style.left = pE - 10+ "px";
        }
        else if (pE<=(l21Left+10))
            a=0;
        if (a==0)
        {
            if (pE<(l27L-5-l27W)) 
            {
                blue.style.left = pE + 10+ "px";
            }
            else if (pE>=(l27L-10-l27W))
                a=1;
        }
        

        if (pE2>l26Left+5) 
        {
            blue2.style.left = pE2 - 10+ "px";
        }
        else if (pE2<=(l26Left+10))
            b=0;
        if (b==0)
        {
            if (pE2<(l23L-l26W-l23W-5)) 
            {
                blue2.style.left = pE2 + 10+ "px";
            }
            else if (pE2>=(l23L-l26W-l23W-10))
            b=1;
        }
///********************************** */
        if (pE5>(l37T+10+l37H)) 
        {
            blue5.style.top = pE5 - 10+ "px";
        }
        else if (pE5<l37T+20+l37H)
            c=0;
        if (c==0)
        {
            if (pE5<l22T-l22H-l37H) 
            {
                blue5.style.top = pE5 + 10+ "px";
            }
            else if (pE5=l22T-l22H-l37H)
                c=1;
        }
    }
}

setInterval(moveHorizontal, 50) 



// ===>  gestion des touches du clavier

document.addEventListener('keydown', function (event) {
    var speed = 5; // vitesse de déplacement
    var event = event || window.event, // pour la compatibilite avec tous les navigateurs
        keyCode = event.keyCode;
    switch (keyCode) {
        case 37: // gauche(100)
            move(-speed, 0);
            document.getElementById("gauche").style.left="0";
            document.getElementById("droite").style.left="0";
            document.getElementById("gauche").style.top="0.25vw";
            document.getElementById("droite").style.top="0.25vw";
            break;
        case 38: // haut(104)
            move(0, -speed);
            document.getElementById("gauche").style.left="0.25vw";
            document.getElementById("droite").style.left="0.25vw";
            document.getElementById("gauche").style.top="0";
            document.getElementById("droite").style.top="0";
            document.getElementsByClassName("blue")[0].style.left;
            break;
        case 39: // droite(102)
            move(speed, 0);
            document.getElementById("gauche").style.left="0.6vw";
            document.getElementById("droite").style.left="0.6vw";
            document.getElementById("gauche").style.top="0.25vw";
            document.getElementById("droite").style.top="0.25vw";
            break;
        case 40: // bas(98)
            move(0, speed)
            document.getElementById("gauche").style.left="0.25vw";
            document.getElementById("droite").style.left="0.25vw";
            document.getElementById("gauche").style.top="0.6vw";
            document.getElementById("droite").style.top="0.6vw";
            document.getElementsByClassName("blue")[0].style.left;
            break;
        // case 32:
        //     body=document.getElementsByTagName("body")[0];
        //     if(body.id=="niveau2")
        //     {
        //         blue=document.getElementsByClassName("blue")[0];
        //         var styleBlue = window.getComputedStyle(blue, null);
        //         var pE = parseInt(styleBlue.left);
        //         if (pE>83) 
        //         {
        //             blue.style.left = pE - 10+ "px";
        //         }
        //         else
        //             blue.style.left = pE + 10+ "px";
        //     }
        //     break;
            // case 17:
            //     body=document.getElementsByTagName("body")[0];
            //     if(body.id=="niveau2")
            //     {
            //         blue=document.getElementsByClassName("blue")[0];
            //         var styleBlue = window.getComputedStyle(blue, null);
            //         var pE = parseInt(styleBlue.left);
            //         if (pE<283) 
            //         {
            //             blue.style.left = pE + 10+ "px";
            //         }
            //         else
            //             blue.style.left = pE - 10+ "px";
            //     }
            //     break;
        // case 103: // haut gauche
        //     move(-speed, -speed);
        //     break;
        // case 105: // haut droite
        //     move(speed, -speed);
        //     break;
        // case 97: // bas gauche
        //     move(-speed, speed);
        //     break;
        // case 99: // bas droite
        //     move(speed, speed);
        //     break;
    }
});


body=document.getElementsByTagName("body")[0];
    if(body.id=="niveau1")
    {
        blockRouge = document.getElementsByClassName("red");
        if(blockRouge!= 'undefined')
        for (i = 1; i < 6; i++) {
        blockRouge[i].style.display = "none";
        }
    }
    // else if (body.id=="niveau2")
    // {
    //     blockBlue = document.getElementsByClassName("blue");
    //     for(i=0;i<6;i++)
    //     {
    //         blockBlue[i].style.left=parseInt(blockBlue[i].style.left)+5+"px";
    //     }
    // }



