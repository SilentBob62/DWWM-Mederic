<?php
//fichier pour appel AJAX

// on definit les parametres
require "../Controller/Parametre.class.php";
Parametre::init();
//Connection BDD
require "DbConnect.class.php";
DbConnect::init();
//Recherche en base de données
$db = DbConnect::getDb(); // Instance de PDO.
// on récupère le paramètre
$idReg = $_POST["idRegion"];
// Recherche des département en base de données.
$q = $db->query('SELECT idDepartement,libelleDepartement FROM departements  where IdRegion = '.$idReg.' order by libelleDepartement');
if ($donnees = $q->fetch(PDO::FETCH_OBJ)) {//test si la requête renvoi des données
    do {
        $departs[] = $donnees;
    } 
    while ($donnees = $q->fetch(PDO::FETCH_OBJ));
    //encodage des données en JSON
    echo json_encode($departs);
} 

