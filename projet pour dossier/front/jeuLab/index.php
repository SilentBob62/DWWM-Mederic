<?php

$nom=(isset($_SESSION['nom']))? $_SESSION['nom']:'';
$piece=(isset($_SESSION['piece']))?(int) $_SESSION['piece']:0;
session_start();
if (isset($_GET["act"]))
{
    if ($_GET["act"]=="jeu")
    {
        include "head.php";
        include "header.php";
        include "jeu.php";
        include "footer.php";
        AfficherPage("jeu");  
    }  
    else if ($_GET["act"]=="niveau2")
    {
        include "head.php";
        include "header.php";
        include "niveau2.php";
        include "footer.php";
    }    
    else if ($_GET["act"]=="gameover")
    {
        include "head.php";
        include "header.php";
        include  "gameover.php";
    }    
}
else 
{
    include "head.php";
    include "header.php";
    include  "menu.php";
}