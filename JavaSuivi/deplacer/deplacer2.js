function deplace(dx,dy) {
    document.getElementById('objet').style.top
      = parseInt(document.getElementById('objet').style.top)+dy+'px';
    document.getElementById('objet').style.left
      = parseInt(document.getElementById('objet').style.left)+dx+'px';
    }