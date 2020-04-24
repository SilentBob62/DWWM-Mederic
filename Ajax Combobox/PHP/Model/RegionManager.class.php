<?php

class RegionManager
{
    public static function getList()
    {
        $db = DbConnect::getDb(); // Instance de PDO.
        // Retourne la liste de tous les Regions.

        $q = $db->query('SELECT idRegion, LibelleRegion FROM Regions ORDER BY libelleregion');

        if ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {//test si la requête renvoi des données
            do {
                $regs[] = new Region($donnees);
            } while ($donnees = $q->fetch(PDO::FETCH_ASSOC));
            return $regs;
        } else {
            return null;
        }
    }
}
