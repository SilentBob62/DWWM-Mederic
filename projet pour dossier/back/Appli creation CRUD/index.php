<?php
function AfficherPage($nom)
{
    include "head.php";
    include "header.php";
    include  $nom . ".php";
    include "footer.php";
}




if (isset($_GET["act"]))
{
    if ($_GET["act"]=="confirmation")
    {
        AfficherPage("confirmation");  
    }           
}
else 
{
    AfficherPage("form");
}