validerNombre=document.getElementById("validerNombre");


validerNombre.addEventListener("click",function(){
    table=document.getElementById("nbTable");
    for(i=0;i<table.value;i++)
    {
        formulaire=document.getElementById("formulaire");
        div = document.createElement("div");
        div.setAttribute("class","donnee plus");
        formulaire.appendChild(div); 
        formulaire=document.getElementById("formulaire");
        div = document.createElement("div");
        div.setAttribute("class","donnee pluss");
        formulaire.appendChild(div); 
        formulaire=document.getElementById("formulaire");
        div = document.createElement("div");
        div.setAttribute("class","donnee plusss");
        formulaire.appendChild(div);   
    }

    formulaire=document.getElementById("formulaire");
    div = document.createElement("div");
    div.setAttribute("class","donnee bas");
    formulaire.appendChild(div);   

    plus=document.getElementsByClassName("plus");
    pluss=document.getElementsByClassName("pluss");
    plusss=document.getElementsByClassName("plusss");
    bas=document.getElementsByClassName("bas")[0];

    for(i=0;i<table.value;i++)
    {
        label=document.createElement("label");
        label.setAttribute("class","vert");
        label.setAttribute("for","table"+i);
        label.innerHTML="Nom de la table "+(i+1);
        plus[i].appendChild(label);
        input=document.createElement("input");
        input.setAttribute("name","table"+i);
        input.setAttribute("type","text");
        plus[i].appendChild(input);
        div=document.createElement("div");
        div.setAttribute("class","message");
        plus[i].appendChild(div);

        label=document.createElement("label");
        label.setAttribute("class","vert");
        label.setAttribute("for","idTable"+i);
        label.innerHTML="Id de la table "+(i+1);
        pluss[i].appendChild(label);
        input=document.createElement("input");
        input.setAttribute("name","idTable"+i);
        input.setAttribute("type","text");
        pluss[i].appendChild(input);
        div=document.createElement("div");
        div.setAttribute("class","message");
        pluss[i].appendChild(div);

        label=document.createElement("label");
        label.setAttribute("class","vert");
        label.setAttribute("for","classe"+i);
        label.innerHTML="Nom de la classe "+(i+1);
        plusss[i].appendChild(label);
        input=document.createElement("input");
        input.setAttribute("name","classe"+i);
        input.setAttribute("type","text");
        plusss[i].appendChild(input);
        div=document.createElement("div");
        div.setAttribute("class","message");
        plusss[i].appendChild(div);

    }

    div=document.createElement("div");
    div.setAttribute("class","espace");
    bas.appendChild(div);

    div=document.createElement("div");
    div.setAttribute("class","bouton");
    bas.appendChild(div);

    bouton=document.getElementsByClassName("bouton")[0];

    input=document.createElement("input");
    input.setAttribute("class","validerNombre");
    input.setAttribute("type","submit");
    input.setAttribute("value","OK");
    bouton.appendChild(input);

    div=document.createElement("div");
    div.setAttribute("class","espace");
    bas.appendChild(div);

    div = document.createElement("div");
    div.setAttribute("class","basDePage");
    formulaire.appendChild(div);   

    validerNombre.style.display="none";

});

