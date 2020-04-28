<?php
class Manager
{
public static function add( $obj)
{
$db = DbConnect::getDb();
$q = $db->prepare("INSERT INTO  () VALUES ()");
 $q->execute();
}

public static function update( $obj)
{
$db = DbConnect::getDb();
$q = $db->prepare("UPDATE  SET  WHERE =:");
$q->bindValue(":id", $obj->get());
 $q->execute();
}

public static function delete( $obj)
{
$db = DbConnect::getDb();
$db->exec("DELETE FROM  WHERE =" . $obj->get());
}

public static function findById($id)
{
$db = DbConnect::getDb();
$id = (int) $id;
$q = $db->query("SELECT * FROM  WHERE =$id");
$results = $q->fetch(PDO::FETCH_ASSOC);
if ($results != false) {
return new  ($results);
 }else {
return false;
}
}

public static function getList()
{
$db = DbConnect::getDb();
$ = [];
$q = $db->query("SELECT * FROM ");
while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
if ($donnees != false) {
$[] = new ($donnees);
}
}
return $;
 }

}