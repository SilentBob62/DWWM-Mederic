<?php
var_dump($_POST);

$p = new Personne($_POST);
var_dump($p);
switch ($_GET["act"])
{
    case "ajout":
        PersonneManager::add($p);
        break;
    case "modif":
        PersonneManager::update($p);
        break;
    case "suppr":
        PersonneManager::delete($p);
        break;
}
header("location:index.php?action=confirmation");
