<?php
// ====================================================================//
// ============================Générateur==============================//
// ====================================================================//


//depuis generate.html

$projet=$_POST["projet"];
$host= $_POST["host"];
$port= $_POST["port"];
$login= $_POST["login"];
$MDP= $_POST["MDP"];
$nomBDD= $_POST["BDD"];
$nbTable= $_POST["nbTable"];




// on vérifie que les différents dossiers existent sinon on les crées
if (!file_exists('../'.$projet))
    mkdir('../'.$projet);
if (!file_exists('../'.$projet.'/php'))
    mkdir('../'.$projet.'/php');
if (!file_exists('../'.$projet.'/php/view'))
    mkdir('../'.$projet.'/php/view');
if (!file_exists('../'.$projet.'/php/controller'))
    mkdir('../'.$projet.'/php/controller');
if (!file_exists('../'.$projet.'/php/model'))
    mkdir('../'.$projet.'/php/model');
if (!file_exists('../'.$projet.'/css'))
    mkdir('../'.$projet.'/css');
if (!file_exists('../'.$projet.'/js'))
    mkdir('../'.$projet.'/js');
if (!file_exists('../'.$projet.'/images'))
    mkdir('../'.$projet.'/images');

//on crée le dbConnect
$affichage = fopen('../'.$projet.'/php/model/DbConnect.class.php', 'w');
fputs($affichage ,genereDbConnect());

$affichage=fopen('../'.$projet.'/parametre.ini','w');
fputs($affichage ,  genereParametreIni($host,$port,$nomBDD,$login,$MDP));

$affichage = fopen('../'.$projet.'/php/controller/Parametre.Class.php', 'w');
fputs($affichage ,genereParametreClass());

$affichage = fopen('DbConnect.Class.php', 'w');
fputs($affichage ,genereDbConnectClass($host,$login,$port,$MDP));

$affichage = fopen('../'.$projet.'/php/view/confirmation.php', 'w');
fputs($affichage ,genereConfirmation());

$affichage = fopen('../'.$projet.'/php/view/footer.php', 'w');
fputs($affichage ,genereFooter());

$affichage = fopen('../'.$projet.'/php/view/head.php', 'w');
fputs($affichage ,genereHead());


    require 'DbConnect.class.php';
    DbConnect::init($nomBDD); // ne pas oublier de changer les identifiants dans le fichier de connexion si besoin
    $db= DbConnect::getDb(); // on se connnecte à la base de données

for($i=0;$i<$nbTable;$i++)
{
    $nomTable= $_POST["table".$i];
    $idTable= $_POST["idTable".$i];
    $nomClass= $_POST["classe".$i];  
    // on met une majuscule à $nomClass au cas où et on appelle la fonction de création
    $nomClass = ucfirst($nomClass);
    
    $affichage = fopen('../'.$projet.'/php/view/'.$nomClass.'Liste.php', 'w');
    fputs($affichage ,genereListe($nomClass));

    $affichage = fopen('../'.$projet.'/php/view/'.$nomClass.'Action.php', 'w');
    fputs($affichage ,genereAction($nomClass));

    $affichage = fopen('../'.$projet.'/php/view/'.$nomClass.'Form.php', 'w');
    fputs($affichage ,genereForm($class));

    $affichage = fopen('../'.$projet.'/index.php', 'w');
    fputs($affichage ,genereIndex($class));

    // on va chercher la liste des colonnes de la table
    $q = $db->query('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . $nomBDD . '" AND TABLE_NAME = "' . $nomTable .'" ORDER BY ORDINAL_POSITION;');
    // on boucle puis on retire la dernière valeur vide
    while ($listeColonnes[] = $q->fetch(PDO::FETCH_ASSOC)["COLUMN_NAME"]) {}
    unset($listeColonnes[array_key_last($listeColonnes)]);

    generation($nomTable, $nomClass, $idTable, $listeColonnes,$projet);
    unset($listeColonnes);
}

//suprime le DbConnect qui sert au programme
unlink('DbConnect.Class.php');

header('Location:index.php?act=confirmation');
// ====================================================================//
// ============================GENERATION==============================//
// ====================================================================//

function generation($nomTable, $nomClass, $idTable, $listeColonnes,$projet)
{
    // on crée un fichier pour l'affichage
    $affichage = fopen('../'.$projet.'/php/view/' . $nomClass . 'Affichage.Class.php', 'w');
    fputs($affichage, genererAffichage($nomTable, $nomClass, $idTable, $listeColonnes));

    // on crée un  fichier pour la class
    $class = fopen('../'.$projet.'/php/controller/' . $nomClass . '.Class.php', 'w');
    fputs($class, genererClass($nomClass, $listeColonnes));

    // on crée un fichier pour le manager
    $manager = fopen('../'.$projet.'/php/model/' . $nomClass . 'Manager.Class.php', 'w');
    fputs($manager, genererManager($nomTable, $nomClass, $idTable, $listeColonnes));
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
function genereDbConnectClass($host,$utilisateur,$port,$motDePasse)
{
    $affichage='
    <?php
    class DbConnect {

	private static $db;
	
	public static function getDb() {
		return DbConnect::$db;
	}

    public static function init($base)
        {
            $host = "'.$host.'";
            $utilisateur = "'.$utilisateur.'";
            $motDePasse = "'.$motDePasse.'";
            $port='.$port.';
            try {
                self::$db = new PDO('."'".'mysql:host='."'".' . $host . '."'".';port='."'".'.$port.'."'".'; charset=utf8; dbname='."'".' . $base, $utilisateur, $motDePasse);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage() . "<br />";
                echo "N° : " . $e->getCode();
                die("Fin du script");
            }
        }
    }
    ';
    return $affichage;
}
function genereParametreClass()
{
    $affichage='
    <?php
    class Parametre
    {
        private static $_host;
        private static $_port;
        private static $_dbName;
        private static $_login;
        private static $_pwd;

        public static function getHost()
        {
            return self::$_host;
        }

        public static function getPort()
        {
            return self::$_port;
        }

        public static function getDbName()
        {
            return self::$_dbName;
        }

        public static function getLogin()
        {
            return self::$_login;
        }

        public static function getPwd()
        {
            return self::$_pwd;
        }
        public static function init()
        {
            // si le fichier existe
            if (file_exists("parametre.ini"))
            {//appel habituel depuis index
                $fic = "parametre.ini";
            }
            else
            // si l\'API est appelé, l\'appel ce fait depuis le dossier Controller, il faut repartir à la racine
            if (file_exists("../../parametre.ini"))
            {
                $fic = "../../parametre.ini";
            }
            else
            {
                echo "Pas de fichier de paramètres";
            }

            $flux = fopen($fic, "r"); //on ouvre le fichier en lecture
            //tant qu\'il y a des lignes
            while (!feof($flux))
            {
                $ligne = fgets($flux, 4096);
                if ($ligne) // si la ligne n\'est pas vide
                {
                    $info = explode(":", $ligne); // on sépare la ligne selon le ;
                    $param[$info[0]] = rtrim($info[1]); //on remplit un tableau associatif avec la 1ere partie en clé, la 2nde en valeur
                }
            }
            // on remplie les attributs de la classe
            self::$_host = $param["Host"];
            self::$_port = $param["Port"];
            self::$_dbName = $param["DbName"];
            self::$_login = $param["Login"];
            self::$_pwd = $param["Pwd"];

        }

    }
    ';
    return $affichage;
}
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
        $gen .= '$this->get' . ucfirst($uneColonne) . "() . ";
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
// ====================================================================//
// ===========================lien avec BDD============================//
// ====================================================================//

function genereDbConnect()
{
    $affichage='
    <?php

    // Ce fichier sera inclus � chaque fois que l\'on aura besoin d\'acceder � la base de donn�es.
    // Il permet d\'ouvrir la connection � la base de donn�es
    class DbConnect {
	    private static $db;
	
	    public static function getDb() {
		    return DbConnect::$db;
	    }

	    public static function init() {
		    try {
			    // On se connecte � MySQL
			    self::$db= new PDO ('."'".'mysql:host='."'".'.Parametre::getHost().'."'".';port='."'".'.Parametre::getPort().'."'".';dbname='."'".'.Parametre::getDbName().'."'".';charset=utf8'."'".', Parametre::getLogin(),Parametre::getPwd() );
		    } catch ( Exception $e ) {
			    // En cas d\'erreur, on affiche un message et on arr�te tout
			die ('."'". 'Erreur : '."'".' . $e->getMessage () );
		    }
	    }
    }';
    return $affichage;
}

function genereParametreIni($host,$port,$nomBDD,$login,$MDP)
{
    $affichage='
    Host:'.$host.'
    Port:'.$port.'
    DbName:'.$nomBDD.'
    Login:'.$login.'
    Pwd:'.$MDP;
    return $affichage;
     
}

function genereConfirmation()
{
    $affichage='
    <div class="confirmation center">
        <h2>Vos données ont été enregistrées</h2>
        <a href="index.php?action=accueil">retour</a>
    </div>
    ';
    return $affichage;
}

function genereFooter()
{
    $affichage='
            <footer></footer>
        </body>
    </html>

    ';
    return $affichage;
}

function genereHead()
{
    $affichage='
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <meta content="IE=edge" http-equiv=X-UA-Compatible>
        <meta content="width=device-width, initial-scale=1" name="viewport">
    </head>
    <body>
    ';
    return $affichage;
}
function genereListe($class)
{
    $affichage='
    <?php
    $affichage ='."'".'
    <div class="liste"><h2>Liste de '.$class.'s</h2>
        <div class="entete">
        <div class="titre_entete">Action</div>
        <div class="titre_entete">Nom</div>
        <div class="titre_entete">Prenom</div>
            <div class="titre_entete">Date de naissance</div>
            <div class="titre_entete long">adresse</div>
            <div class="titre_entete">ville</div>
            <div class="titre_entete">code postal</div>
            <div class="titre_entete long">e-mail</div>
        </div>'."'".';
    $liste'.$class.' = '.$class.'Manager::getList();
    foreach ($liste'.$class.' as $'.$class.')
    {
        $affichage .= '."'".'<div class="contenuListe">
        <a href="index.php?action='.$class.'Form&id='."'".'.$'.$class.'->getId'.$class.'().'."'".'&act=modif">   <div class="contenu"> MODIF </div></a>
        <a href="index.php?action='.$class.'Form&id='."'".'.$'.$class.'->getId'.$class.'().'."'".'&act=suppr">   <div class="contenu"> SUPPR </div></a>
        <div class="contenu">'."'".'.$'.$class.'->getNom() . '."'".'</div>
        <div class="contenu">'."'".'.$'.$class.'->getPrenom() .'."'".'</div>
        <div class="contenu">'."'".'.$'.$class.'->getDateNaissance() .'."'".'</div>
        <div class="contenu long">'."'".'.$'.$class.'->getAdresse() .'."'".'</div>
        <div class="contenu">'."'".'.$'.$class.'->getVille() .'."'".'</div>
        <div class="contenu">'."'".'.$'.$class.'->getCode() .'."'".'</div>
        <div class="contenu long">'."'".'.$'.$class.'->getEmail() .'."'".'</div>
        </div>'."'".';

    }

    $affichage .='."'".'<a class="btncentre" href="index.php?action='.$class.'Form&act=ajout">Ajoutez un '.$class.'</a></div>  '."'".';

    echo $affichage;

    ';
    return $affichage;
}
function genereAction($class)
{
    $affichage='
    <?php
    var_dump($_POST);

    $p = new '.$class.'($_POST);
    var_dump($p);
    switch ($_GET["act"])
    {
        case "ajout":
            '.$class.'Manager::add($p);
            break;
        case "modif":
            '.$class.'Manager::update($p);
            break;
        case "suppr":
            '.$class.'Manager::delete($p);
            break;
    }
    header("location:index.php?action=confirmation");
    ';
    return $affichage;
}
function genereForm($class)
{
    $affichage='
    <?php

    //on recupere l\'action à mener (ajout/modif/suppression)
    $act = $_GET["act"];
    if ($act != "ajout")
    {
    // on recupere l\'id de la '.$class.' à modifier ou à supprimer via le $_GET
        $id = $_GET["id"];
        $p = '.$class.'Manager::getById($id);
    }
    ?>
    <div class="formulaire center">
        <form action="index.php?action='.$class.'Action&act=<?php echo $act; ?>" method="POST">
            <fieldset>
                <legend><i class="fas fa-address-card"></i>Vos coordonnées</legend>
                <label for="nom">Votre nom*</label>
                <!--on renseigne la value dans l\'input si on est en modif ou suppr -->
                <input type="text" name="nom" id="nom" maxlength="30" required <?php if ($act != "ajout")
    {
        echo '."'".'value ="'."'".' . $p->getNom() . '."'".'"'."'".';
    }
    ?> >
                <!--  on met l\'id dans un champ caché pour qu\'il soit renseigné dans le $_POST au moment de la validation du formulaire  -->
                <?php if ($act != "ajout")
    {
        echo'."'".'<input type="text" name="id'.$class.'" id="id'.$class.'" hidden value ="'."'".' . $p->getId'.$class.'() . '."'".'" >'."'".';
    }
    ?>

                <label for="prenom">Votre prenom*</label>
                <input type="text" name="prenom" id="prenom"required <?php if ($act != "ajout")
    {
        echo'."'". 'value ="'."'".' . $p->getPrenom() . '."'".'"'."'".';
    }
    ?> >

                <label for="dateNaissance">Votre date de naissance*</label>
                <input type="date" name="dateNaissance" id="dateNaissance"required <?php if ($act != "ajout")
    {
        echo'."'".'value ="'."'".' . $p->getDateNaissance() . '."'".'"'."'".';
    }
    ?> >

            </fieldset>
                <div class="btn">
                    <button type="submit" name="modifier"> <?php if ($act == "ajout")
    {
        echo'."'". 'Ajouter'."'".';
    }
    elseif ($act == "modif")
    {
        echo'."'". 'Modifier'."'".';
    }
    else
    {
        echo "Supprimer";
    }
    ?></button>
                <a href="index.php?action=accueil">    <button type="reset" name="annuler" class="annule"> Annuler</button></a>
                </div>
            </fieldset>
        </form>
    </div>
        ';
    return $affichage;
}

function genereIndex($class){
    $affichage='
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
            case "'.$class.'Form":
                AfficherPage("'.$class.'Form");
                break;
            case "'.$class.'Action":
                AfficherPage("'.$class.'Action");
                break;
        }
    }
    else
    {
        AfficherPage("liste");
    }

    ';
    return $affichage;
}