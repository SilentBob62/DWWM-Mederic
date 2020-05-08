<?php


session_start();
if (isset($_GET["act"]))
{
    if ($_GET["act"]=="jeu")
    {
        include "head.php";
        include "header.php";
        include "jeu.php";
        include "footer.php";
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
        include  "gameover.php";
    }    
}
else 
{
    include "head.php";
    include "header.php";
    include  "menu.php";
}