<?php
class PersonneManager
{
    public static function add(Personne $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO personne (nom,prenom,dateNaissance, adresse, ville, code, email) VALUES(:nom, :prenom, :dateNaissance, :adresse, :ville, :code, :email)");
        $q->bindValue(":nom", $obj->getNom());
        $q->bindValue(":prenom", $obj->getPrenom());
        $q->bindValue(":dateNaissance", $obj->getDateNaissance());
        $q->bindValue(':adresse', $obj->getAdresse());
        $q->bindValue(':ville', $obj->getVille());
        $q->bindValue(':code', $obj->getCode());
        $q->bindValue(':email', $obj->getEmail());

        $q->execute();
    }

    public static function update(Personne $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare('UPDATE personne SET nom=:nom, prenom=:prenom ,dateNaissance=:dateNaissance ,adresse=:adresse, ville=:ville, code=:code, email=:email WHERE idPersonne = :idPersonne');
        $q->bindValue(":nom", $obj->getNom());
        $q->bindValue(":prenom", $obj->getPrenom());
        $q->bindValue(":dateNaissance", $obj->getDateNaissance());
        $q->bindValue(':adresse', $obj->getAdresse());
		$q->bindValue(':ville', $obj->getVille());
        $q->bindValue(':code', $obj->getCode());
        $q->bindValue(':email', $obj->getEmail());
        $q->bindValue(":idPersonne", $obj->getIdPersonne());
        $q->execute();
    }

    public static function delete(Personne $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM personne WHERE  idPersonne = ".$obj->getIdPersonne());
    }

    public static function getById($id)
    {
        $db = DbConnect::getDb();
        $q = $db->query("SELECT * FROM personne WHERE idPersonne =" ."$id");
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Personne($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $personne = [];
        $q = $db->query("SELECT idPersonne, nom, prenom, dateNaissance, adresse, ville, code, email FROM personne ");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $personne[] = new Personne($donnees);
            }
        }
        return $personne;
    }
    static public function count()
	{
		$db = DbConnect::getDb(); // Instance de PDO.
		// Retourne la liste de tous les personnes.
		
		$q = $db->query('SELECT count(*) as nb FROM personne');
		
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		
		return $donnees;
	}
}
