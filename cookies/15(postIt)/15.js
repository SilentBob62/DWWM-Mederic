/**variables */
/*############################################ */
var mouse_down = false;

/**les recherches */
/*############################################ */
postIt=document.getElementById("postIt1");

/**actions */
/*############################################ */
document.onmousemove = on_mouse_move;
document.onmouseup = on_mouse_up;

postIt.addEventListener("dblclick",function (){
    if(postIt.style.height=="15vw"){
        retrecir();
    }    
    else{
        agrandir();
    }
    
})

/**fonctions */
/*############################################ */
function on_mouse_move(e) {
  if (mouse_down === true) {
    document.querySelector('#postIt1').style.left = event.clientX-50+'px';
    document.querySelector('#postIt1').style.top = event.clientY-50+'px';
  }
}

function on_mouse_down_objet(e) {
 mouse_down=true;
}

function on_mouse_up(e){
 mouse_down=false;
}
function retrecir(){
    postIt.style.height="2vw";
}
function agrandir(){
    postIt.style.height="15vw";
}
  