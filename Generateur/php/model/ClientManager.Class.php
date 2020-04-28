<?php
class ClientManager
{
public static function add(Client $obj)
{
$db = DbConnect::getDb();
$q = $db->prepare("INSERT INTO clients (nomClient,prenomClient,adresseClient) VALUES (:nomClient,:prenomClient,:adresseClient)");
$q->bindValue(":nomClient", $obj->getNomClient());
$q->bindValue(":prenomClient", $obj->getPrenomClient());
$q->bindValue(":adresseClient", $obj->getAdresseClient());
 $q->execute();
}

public static function update(Client $obj)
{
$db = DbConnect::getDb();
$q = $db->prepare("UPDATE clients SET nomClient=:nomClient, prenomClient=:prenomClient, adresseClient=:adresseClient WHERE idClient=:idClient");
$q->bindValue(":nomClient", $obj->getNomClient());
$q->bindValue(":prenomClient", $obj->getPrenomClient());
$q->bindValue(":adresseClient", $obj->getAdresseClient());
$q->bindValue(":idClient", $obj->getIdClient());
 $q->execute();
}

public static function delete(Client $obj)
{
$db = DbConnect::getDb();
$db->exec("DELETE FROM clients WHERE idClient=" . $obj->getIdClient());
}

public static function findById($id)
{
$db = DbConnect::getDb();
$id = (int) $id;
$q = $db->query("SELECT * FROM clients WHERE idClient=$id");
$results = $q->fetch(PDO::FETCH_ASSOC);
if ($results != false) {
return new Client ($results);
 }else {
return false;
}
}

public static function getList()
{
$db = DbConnect::getDb();
$clients = [];
$q = $db->query("SELECT * FROM clients");
while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
if ($donnees != false) {
$clients[] = new Client($donnees);
}
}
return $clients;
 }

}