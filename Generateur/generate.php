<?php
// popen("cls", "w");
// echo "==========================================\n";
// echo "=================Générateur===============\n";
// echo "==========================================\n\n";

// ========================================================================================================================== //
// => Pour générer hors-ligne, commenter la ligne 12 à 25 et décommenter les lignes 27 à 30 et remplir les variables ======== //
// => Pour générer avec une BDD, commenter les 27 à 30, décommenter les lignes 12 à 25 et remplir DbConnect.Class.php ======= //
// ========================================================================================================================== //
// on demande le nom de la base de données, le nom de la table à exploiter, son champ ID et le nom de la classe voulue

// $nomBDD = readline('=> Nom de la base de données : ');
// $nomTable = readline('=> Nom de la table : ');
// $idTable = readline('=> Champ ID de la table : ');
// $nomClass = readline('===> Nom de la classe : ');

//depuis generate.html
$nomBDD= $_POST["BDD"];
$nomTable= $_POST["table"];
$idTable= $_POST["idTable"];
$nomClass= $_POST["classe"];
// on met une majuscule à $nomClass au cas où et on appelle la fonction de création
$nomClass = ucfirst($nomClass);

require 'DbConnect.class.php';
DbConnect::init($nomBDD); // ne pas oublier de changer les identifiants dans le fichier de connexion si besoin
$db = DbConnect::getDb(); // on se connnecte à la base de données

// on va chercher la liste des colonnes de la table
$q = $db->query('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . $nomBDD . '" AND TABLE_NAME = "' . $nomTable . '"');
// on boucle puis on retire la dernière valeur vide
while ($listeColonnes[] = $q->fetch(PDO::FETCH_ASSOC)["COLUMN_NAME"]) {}
unset($listeColonnes[array_key_last($listeColonnes)]);

// $nomTable = "etats_civils";
// $nomClass = "etatCivil";
// $idTable = "id";
// $listeColonnes = array('id', 'nom', 'prenom', 'genre');
// ========================================================================================================================== //
// ========================================================================================================================== //
// variables css
// ========================================================================================================================== //
// ========================================================================================================================== //

// on vérifie que les différents dossiers PHP existent sinon on les crées
if (!file_exists('php'))
    mkdir('php');
if (!file_exists('php/view'))
    mkdir('php/view');
if (!file_exists('php/controller'))
    mkdir('php/controller');
if (!file_exists('php/model'))
    mkdir('php/model');
if (!file_exists('css'))
    mkdir('css');
if (!file_exists('js'))
    mkdir('js');
if (!file_exists('images'))
    mkdir('images');



generation($nomTable, $nomClass, $idTable, $listeColonnes);

// ====================================================================//
// ============================GENERATION==============================//
// ====================================================================//

function generation($nomTable, $nomClass, $idTable, $listeColonnes)
{
    // on crée un fichier pour l'affichage
    $affichage = fopen('php/view/' . $nomClass . 'Affichage.Class.php', 'w');
    fputs($affichage, genererAffichage($nomTable, $nomClass, $idTable, $listeColonnes));
    echo $nomClass . 'Affichage.Class.php crée dans php/controller/' . "\n";

    // on crée un  fichier pour la class
    $class = fopen('php/controller/' . $nomClass . '.Class.php', 'w');
    fputs($class, genererClass($nomClass, $listeColonnes));
    echo $nomClass . '.Class.php crée dans php/controller/' . "\n";

    // on crée un fichier pour le manager
    $manager = fopen('php/model/' . $nomClass . 'Manager.Class.php', 'w');
    fputs($manager, genererManager($nomTable, $nomClass, $idTable, $listeColonnes));
    echo $nomClass . 'Manager.Class.php crée dans php/model/' . "\n";
}

// ====================================================================//
// =============================AFFICHAGE==============================//
// ====================================================================//

function genererAffichage($nomTable, $nomClass, $idTable, $listeColonnes)
{
    $key = array_search($idTable, $listeColonnes); // on retire le champ ID de $listeColonnes
    if ($key !== false) {
        unset($listeColonnes[$key]);
    }
    
    $affichage = "<?php \n" . 'class ' . $nomClass . "Affichage\n{\n";
    $affichage .= genererListe($nomTable, $nomClass, $listeColonnes) . "\n";
    $affichage .= genererDetails($nomTable, $nomClass, $listeColonnes) . "\n";
    $affichage .= "}";

    return $affichage;
}

function genererListe($nomTable, $nomClass, $listeColonnes)
{
    $entete = '?>'. "\n" . '<div class="ligne">' . "\n";
    foreach ($listeColonnes as $uneColonne) {
        $entete .= '<div class="bloc titre">'. ucfirst($uneColonne) . '</div>' . "\n";
    }
    $entete .= "</div>\n<?php";

    $gen = 'public static function AffichageListe' . $nomClass . '()' . "\n{\n";
    $gen .= '$' . $nomTable . ' = ' . $nomClass . 'Manager::getList();' . "\n";
    $gen .= $entete. "\n" . 'foreach ($' . $nomTable . ' as $elt) {' . "\n?>\n";
    $gen .= '<div class="ligne">' . "\n";

    foreach ($listeColonnes as $uneColonne) {
        $gen .= '<div class="bloc contenu"><?php echo $elt->get' . ucfirst($uneColonne) . '() ?></div>' . "\n";
    }

    $gen .= "</div>\n<?php\n}\n}\n";

    return $gen;
}

function genererDetails($nomTable, $nomClass, $listeColonnes)
{
    $entete = '?>'. "\n" . '<div class="ligne">' . "\n";
    foreach ($listeColonnes as $uneColonne) {
        $entete .= '<div class="bloc titre">'. ucfirst($uneColonne) . '</div>' . "\n";
    }
    $entete .= "</div>\n";

    $gen = 'public static function AffichageDetail' . $nomClass . '($id)' . "\n{\n";
    $gen .= '$' . $nomTable . ' = ' . $nomClass . 'Manager::findById($id);' . "\n";
    $gen .= $entete . "\n" . '<div class="ligne">' . "\n";

    foreach ($listeColonnes as $uneColonne) {
        $gen .= '<div class="bloc contenu"><?php echo "' . $uneColonne . ' : " . $' . $nomTable . '->get' . ucfirst($uneColonne) . '() ?></div>' . "\n";
    }

    $gen .= "</div>\n<?php\n}";

    return $gen;
}

// ====================================================================//
// =============================CLASS==================================//
// ====================================================================//

function genererClass($nomClass, $listeColonnes) //

{
    $class = '<?php' . "\n" . 'class ' . $nomClass . "\n{\n";
    $class .= '/*******************************Attributs*******************************/' . "\n";
    $class .= genererAttributsClass($listeColonnes) . "\n";
    $class .= '/******************************Accesseurs*******************************/' . "\n";
    $class .= genererGetterSetterClass($listeColonnes) . "\n";
    $class .= '/*******************************Construct*******************************/' . "\n";
    $class .= genererConstruct() . "\n";
    $class .= '/****************************Autres méthodes****************************/' . "\n";
    $class .= genererToString($listeColonnes) . "\n";
    $class .= "\n}";
    return $class;
}

function genererAttributsClass($listeColonnes)
{
    $gen = "";

    foreach ($listeColonnes as $uneColonne) {
        $gen .= 'private $_' . $uneColonne . ";\n";
    }

    return $gen;
}

function genererGetterSetterClass($listeColonnes)
{
    $gen = "";

    foreach ($listeColonnes as $uneColonne) {
        $gen .= 'public function get' . ucfirst($uneColonne) . "()\n" . "{\n" . ' return $this->_' . $uneColonne . ";\n}\n";
        $gen .= 'public function set' . ucfirst($uneColonne) . '($_' . $uneColonne . ")\n" . "{\n" . ' return $this->_' . $uneColonne . ' = $_' . $uneColonne . ";\n}\n";
    }

    return $gen;
}

function genererConstruct()
{
    return 'public function __construct(array $options = [])
    {
        if (!empty($options))
        {
            $this->hydrate($options);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable(([$this, $methode])))
            {
                $this->$methode($value);
            }
        }
    }' . "\n";
}

function genererToString($listeColonnes)
{
    $gen = "public function toString() \n{ \n return ";

    foreach ($listeColonnes as $uneColonne) {
        $gen .= '$this->get' . ucfirst($uneColonne) . " . ";
    }

    $gen = substr($gen, 0, strlen($gen) - 2);
    $gen .= ";\n}";

    return $gen;
}

// ====================================================================//
// ===========================MANAGER==================================//
// ====================================================================//

function genererManager($nomTable, $nomClass, $idTable, $listeColonnes)
{
    $key = array_search($idTable, $listeColonnes); // on retire le champ ID de $listeColonnes
    if ($key !== false) {
        unset($listeColonnes[$key]);
    }

    $manager = '<?php' . "\n" . 'class ' . $nomClass . 'Manager' . "\n{\n";
    $manager .= genererAdd($nomTable, $nomClass, $listeColonnes) . "\n\n";
    $manager .= genererUpdate($nomTable, $nomClass, $idTable, $listeColonnes) . "\n\n";
    $manager .= genererDelete($nomTable, $nomClass, $idTable) . "\n\n";
    $manager .= genererFindById($nomTable, $nomClass, $idTable) . "\n\n";
    $manager .= genererGetList($nomTable, $nomClass) . "\n\n";
    $manager .= "}";

    return $manager;
}

function genererAdd($nomTable, $nomClass, $listeColonnes)
{
    $lesAttributs = "";
    $lesVariablesSQL = "";
    $lesBinds = "";

    foreach ($listeColonnes as $uneColonne) {
        $lesAttributs .= $uneColonne . ',';
        $lesVariablesSQL .= ':' . $uneColonne . ',';
        $lesBinds .= '$q->bindValue(":' . $uneColonne . '", $obj->get' . ucfirst($uneColonne) . '());' . "\n";
    }

    $lesAttributs = substr($lesAttributs, 0, strlen($lesAttributs) - 1);
    $lesVariablesSQL = substr($lesVariablesSQL, 0, strlen($lesVariablesSQL) - 1);

    $gen = 'public static function add(' . $nomClass . ' $obj)' . "\n{\n";
    $gen .= '$db = DbConnect::getDb();' . "\n";
    $gen .= '$q = $db->prepare("INSERT INTO ' . $nomTable . ' (' . $lesAttributs . ') VALUES (' . $lesVariablesSQL . ')");' . "\n" . $lesBinds . ' $q->execute();' . "\n" . '}';

    return $gen;
}

function genererUpdate($nomTable, $nomClass, $idTable, $listeColonnes)
{
    $lesAttributs = "";
    $lesBinds = "";

    foreach ($listeColonnes as $uneColonne) {
        $lesAttributs .= $uneColonne . "=:" . $uneColonne . ", ";
        $lesBinds .= '$q->bindValue(":' . $uneColonne . '", $obj->get' . ucfirst($uneColonne) . '());' . "\n";
    }

    $lesBinds .= '$q->bindValue(":id'.$nomClass.'", $obj->get' . ucfirst($idTable) . '());' . "\n";
    $lesAttributs = substr($lesAttributs, 0, strlen($lesAttributs) - 2);

    $gen = 'public static function update(' . $nomClass . ' $obj)' . "\n{\n";
    $gen .= '$db = DbConnect::getDb();' . "\n";
    $gen .= '$q = $db->prepare("UPDATE ' . $nomTable . ' SET ' . $lesAttributs . " WHERE " . $idTable . "=:" . $idTable . "\");\n" . $lesBinds . ' $q->execute();' . "\n" . '}';

    return $gen;
}

function genererDelete($nomTable, $nomClass, $idTable)
{
    $gen = 'public static function delete(' . $nomClass . ' $obj)' . "\n{\n";
    $gen .= '$db = DbConnect::getDb();' . "\n";
    $gen .= '$db->exec("DELETE FROM ' . $nomTable . ' WHERE ' . $idTable . '=" . $obj->get' . ucfirst($idTable).'());' . "\n" . '}';

    return $gen;
}

function genererFindById($nomTable, $nomClass, $idTable)
{
    $gen = 'public static function findById($id)' . "\n{\n";
    $gen .= '$db = DbConnect::getDb();' . "\n";
    $gen .= '$id = (int) $id;' . "\n";
    $gen .= '$q = $db->query("SELECT * FROM ' . $nomTable . ' WHERE ' . $idTable . '=$id");' . "\n";
    $gen .= '$results = $q->fetch(PDO::FETCH_ASSOC);' . "\n";
    $gen .= 'if ($results != false) {' . "\n" . 'return new ' . $nomClass . ' ($results);' . "\n }";
    $gen .= 'else {' . "\n" . 'return false;' . "\n}\n}";

    return $gen;
}

function genererGetList($nomTable, $nomClass)
{
    $gen = 'public static function getList()' . "\n{\n";
    $gen .= '$db = DbConnect::getDb();' . "\n";
    $gen .= '$' . $nomTable . ' = [];' . "\n";
    $gen .= '$q = $db->query("SELECT * FROM ' . $nomTable . '");' . "\n";
    $gen .= 'while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {' . "\n";
    $gen .= 'if ($donnees != false) {' . "\n" . '$' . $nomTable . '[] = new ' . $nomClass . '($donnees);' . "\n}\n";
    $gen .= '}' . "\n";
    $gen .= 'return $' . $nomTable . ';' . "\n }";

    return $gen;
}