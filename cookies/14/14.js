/**fonctions */
/*#########################################*/
function cacherSousMenu(p){
    for (i=0;i<p.length;i++){
        p[i].style.display="none";
    }
}
function montrerSousMenu(p){
    for (i=0;i<p.length;i++){
        p[i].style.display="block";
    } 
}
/**recuperer les elements */
/*#########################################*/
d1 = document.getElementById("d1");
d2 = document.getElementById("d2");
d3 = document.getElementById("d3");
p1=document.getElementsByClassName("sousMenu1");
p2=document.getElementsByClassName("sousMenu2");
p3=document.getElementsByClassName("sousMenu3");
/**pour cacher les sousMenu */
/*#########################################*/
cacherSousMenu(p1);
cacherSousMenu(p2);
cacherSousMenu(p3);
/**Pour les actions */
/*#########################################*/
/**pour le premier menu */
d1.addEventListener("click", function ()  {
    if (p1[0].style.display=="none"){
        montrerSousMenu(p1);
    }
    else{
        cacherSousMenu(p1);
    }
});
/**pour le deuxieme menu */
d2.addEventListener("click", function ()  {
    if (p2[0].style.display=="none"){
        montrerSousMenu(p2);
    }
    else{
        cacherSousMenu(p2);
    }
});
/**pour le troisieme menu */
d3.addEventListener("click", function ()  {
    if (p3[0].style.display=="none"){
        montrerSousMenu(p3);
    }
    else{
        cacherSousMenu(p3);
    }
});
/**avec mouse over*/
/**pour le premier menu */
//d1.addEventListener("mouseover", function () {
//     montrerSousMenu(p1);
// });
// d1.addEventListener("mouseout", function () {
//     cacherSousMenu(p1);
// });
/**pour le deuxieme menu */
// d2.addEventListener("mouseover", function () {
//     montrerSousMenu(p2);
// });
// d2.addEventListener("mouseout", function () {
//     cacherSousMenu(p2);
// });
/**pour le troisieme menu */
// d3.addEventListener("mouseover", function () {
//     montrerSousMenu(p3);
// });
// d3.addEventListener("mouseout", function () {
//     cacherSousMenu(p3);
// });
