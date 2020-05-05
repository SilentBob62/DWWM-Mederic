var mouse_down = false;

function on_mouse_down_objet(e) {
 mouse_down=true;
}

function on_mouse_up(e){
 mouse_down=false;
}

document.onmousemove = on_mouse_move;

document.onmouseup = on_mouse_up;

function on_mouse_move(e) {
  if (mouse_down === true) {
    document.querySelector('#objet').style.left = event.clientX-50+'px';
    document.querySelector('#objet').style.top = event.clientY-50+'px';
  }
} 