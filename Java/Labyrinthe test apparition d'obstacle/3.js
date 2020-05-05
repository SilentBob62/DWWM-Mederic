// ====================================================================================================== Fonctionnement du jeu

// ===> gestion du déplacement

function move(pX, pY) {
    var move = true;

    var player = document.getElementById("player"); // joueur
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

        move = move && collision(oT, oL, oW, oH, pT + pY, pL + pX, pW, pH, color);
    });

    if (move) {
        if (limit(pT + pY, pL + pX, pW)) {
            player.style.top = pT + pY + "px";
            player.style.left = pL + pX + "px";
        }
    }
}

// ===> gestion des collisions (et des différents résultats : dont la victoire)

function collision(oT, oL, oW, oH, pT, pL, pW, pH, color) {
    if (pL < oL + oW && pL + pW > oL && pT < oT + oH && pT + pH > oT) {
        switch (color) {
            case "rgb(0, 128, 0)":
                // si on touche l'arrivée, c'est gagné
                stopSound("music")
                alert("Bien joué, c'est gagné !");
                break;
            case "rgb(0, 0, 0)":
                // si on touche un mur, on perd 2sec
                sec -= 1;
                break;
            case "rgb(255, 0, 0)":
                // si on touche un obstacle rouge, on perd 5sec
                sec -= 3;
                break;
            case "rgb(0, 0, 255)":
                // si on touche un obstacle bleu, on perd 15sec
                sec -= 5;
                break;
            case "rgb(119, 3, 3)":
                // si on touche un obstacle bleu, on perd 15sec
                newobs = document.getElementsByClassName("rougeFonce");
                for (i = 0; i < newobs.length; i++) {
                    newobs[i].setAttribute("id", "m" + i);
                }
                document.getElementById("interupteur1").setAttribute("class","invisible");
                break;

        }
        playSound("soundCollision", 1, false);
        return false;
    }
    return true;
}

// ===> gestion des limites de l'écran

function limit(top, left, width) {
    var limitLeftTop = 0; // limite haut-gauche de la page
    var limitRight = window.innerWidth - width; // limite droite de la page
    var limitBottom = window.innerHeight - width; // limite bas de la page

    if (left < limitLeftTop || top < limitLeftTop || left > limitRight || top > limitBottom) {
        // playSound("soundLimit", 1, false);
        return false;
    }
    return true;
}

// ===>  gestion des touches du clavier

document.addEventListener('keydown', function (event) {
    var speed = 5; // vitesse de déplacement
    var event = event || window.event, // pour la compatibilite avec tous les navigateurs
        keyCode = event.keyCode;

    switch (keyCode) {
        case 38:
            move(0, -speed);
            break;
        case 40:
            move(0, speed);
            break;
        case 37:
            move(-speed, 0);
            break;
        case 39:
            move(speed, 0);
            break;
        // case 36:
        //     move(-speed, -speed);
        //     break;
        // case 35:
        //     move(-speed, speed);
        //     break;
        // case 33:
        //     move(speed, -speed);
        //     break;
        // case 34:
        //     move(speed, speed);
        //     break;
    }
});

// //Pour masquer la division :
// document.getElementById(identifiant_de_ma_div).style.display = none;
// ///Pour afficher la division :
// document.getElementById(identifiant_de_ma_div).style.display = block;