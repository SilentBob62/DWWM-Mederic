<?php
function ChargerClasse($classe)
{
    if (file_exists("PHP/controller/" . $classe . ".Class.php"))
    {
        require "PHP/controller/" . $classe . ".Class.php";
    }

    if (file_exists("PHP/model/" . $classe . ".Class.php"))
    {
        require "PHP/model/" . $classe . ".Class.php";
    }

}
spl_autoload_register("ChargerClasse");
Parametre::init();
DbConnect::init();

function AfficherPage($nom)
{
    include "php/view/head.php";
    include "php/view/" . $nom . ".php";
    include "php/view/footer.php";
}
if (isset($_GET["action"]))
{
    switch ($_GET["action"])
    {
        case "confirmation":
            AfficherPage("confirmation");
            break;
        case "accueil":
            AfficherPage("liste");
            break;
        case "PersonneForm":
            AfficherPage("PersonneForm");
            break;
        case "PersonneAction":
            AfficherPage("PersonneAction");
            break;
    }
}
else
{
    AfficherPage("liste");
}
