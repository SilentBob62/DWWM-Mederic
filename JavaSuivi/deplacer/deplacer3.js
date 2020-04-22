var objet = document.getElementById('objet'),
    x = objet.offsetLeft, // On récupère la position absolue initiale.
    y = objet.offsetTop;
document.onkeydown = function(){

    var   keyCode = event.keyCode;
     
    /* On détecte l'événement puis selon la fleche, on incrémente ou décrément 
    les variables globales de position, i et j.*/
    switch(keyCode){
    case 38:
        y--;
        break;
    case 40:
        y++;
        break;
    case 37:
        x--;
        break;
    case 39:
        x++;
        break;
    }
    // on applique les modifications :
    objet.style.left = x+'px';
    objet.style.top = y+'px';
}