function deplace(dx, dy) {
    var delacement_ok = true;
    var carre = document.getElementById("carre");
    var styleCarre = window.getComputedStyle(carre, null);
    var t = parseInt(styleCarre.top);
    var l = parseInt(styleCarre.left);
    var w = parseInt(styleCarre.width);
    var h = parseInt(styleCarre.height);
    var listeObs=document.querySelectorAll('.mur');
    listeObs.forEach(function (elt){
        var styleObst = window.getComputedStyle(elt, null);
        var tob = parseInt(styleObst.top);
        var lob = parseInt(styleObst.left);
        var wob = parseInt(styleObst.width);
        var hob = parseInt(styleObst.height);
        delacement_ok = delacement_ok && depl_ok(tob, lob, wob, hob, t+dy, l+dx, w, h);
    });
    if (delacement_ok) {
        carre.style.top = t + dy + 'px';
        carre.style.left = l + dx + 'px';
    }
    if (delacement_ok && compteurEspace==0) {
        balle.style.top = t + dy +-15+ 'px';
        balle.style.left = l + dx +30+ 'px';
    }
}
function lanceBalle(dx, dy){
    var balle= document.getElementById("balle");
    var styleBalle = window.getComputedStyle(balle, null);
    var tB = parseInt(styleBalle.top);
    var lB = parseInt(styleBalle.left);
        balle.style.top = tB + dy +'px';
        balle.style.left = lB + dx +'px';
}
function deplaceBalle(dx, dy){
    var delacementBalle_ok = true;
    var balle= document.getElementById("balle");
    var styleBalle = window.getComputedStyle(balle, null);
    var tB = parseInt(styleBalle.top);
    var lB = parseInt(styleBalle.left);
    var wB = parseInt(styleBalle.width);
    var hB = parseInt(styleBalle.height);
    var listeObs=document.querySelectorAll('.mur');
    listeObs.forEach(function (elt){
        var styleObst = window.getComputedStyle(elt, null);
        var tob = parseInt(styleObst.top);
        var lob = parseInt(styleObst.left);
        var wob = parseInt(styleObst.width);
        var hob = parseInt(styleObst.height);
        delacementBalle_ok = delacementBalle_ok && depl_balle_ok(tob, lob, wob, hob, tB+dy, lB+dx, wB, hB);
        });
    var listeObs=document.querySelectorAll('.brique');
    listeObs.forEach(function (elt){
        var styleObst = window.getComputedStyle(elt, null);
        var tob = parseInt(styleObst.top);
        var lob = parseInt(styleObst.left);
        var wob = parseInt(styleObst.width);
        var hob = parseInt(styleObst.height);
        delacementBalle_ok = delacementBalle_ok && depl_balle_ok(tob, lob, wob, hob, tB+dy, lB+dx, wB, hB);
    });
    if (delacementBalle_ok) {
        balle.style.top = tB + dy +'px';
        balle.style.left = lB + dx +'px';
    }
}
function depl_ok(tob, lob, wob, hob, t, l, w, h) {
   if (l < lob + wob && l + w > lob && t < tob + hob && t + h > tob) {
        return false
    }
    return true;
}
function depl_balle_ok(tob, lob, wob, hob, tB, lB, wB, hB){
    if (lB < lob + wob && lB + wB > lob && tB < tob + hob && tB + hB > tob) {
        return false
    }
    return true;
}
    var compteurEspace=0;
document.addEventListener("keydown",function(event) {
    var event = event || window.event, // pour la compatibilite avec tous les navigateurs
        keyCode = event.keyCode;
    var speed = 8;
    var speed2 = 15;
//    alert( keyCode);/*repere les touches utilisé*/ 
    // On détecte l'événement puis selon la fleche, on appelle deplace
    switch (keyCode) {
        // case 38:
        //     deplace(0, -speed);
        //     break;
        // case 40:
        //     deplace(0, speed);
        //     break;
        case 37:
            deplace(-speed, 0);
            break;
        case 39:
            deplace(speed, 0);
            break;
        // case 36:
        //     deplace(-speed, -speed);
        //     break;
        // case 35:
        //     deplace(-speed, speed);
        //     break;
        // case 33:
        //     deplace(speed, -speed);
        //     break;
        // case 34:
        //     deplace(speed, speed);
        //     break;
        /*espace lance la balle */
        case 32:
            if (compteurEspace==0){
                lanceBalle(0, -speed2)
                compteurEspace++;   
                // alert(compteurEspace)
            }
            break;
    }
});

