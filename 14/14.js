menuTitre1=document.getElementsByClassName("menuTitre")[0];
menuTitre2=document.getElementsByClassName("menuTitre")[1];
sousMenu1=document.getElementsByClassName("sousMenuGroupe")[0];
sousMenu2=document.getElementsByClassName("sousMenuGroupe")[1];

menuTitre1.addEventListener("click",function(){
    menuApparait(sousMenu1);
});
menuTitre2.addEventListener("click",function(){
    menuApparait(sousMenu2);
});


function menuApparait(sousMenu){
    if (sousMenu.visibility=="hidden")
	{
        sousMenu.visibility = "visible"; 
    }
    else
    {
        sousMenu.visibility = "hidden"
    }
}