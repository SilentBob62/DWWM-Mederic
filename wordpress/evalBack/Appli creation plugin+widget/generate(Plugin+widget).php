<?php
// ====================================================================//
// ============================Générateur==============================//
// ====================================================================//


//depuis generate.html

$projet=$_POST["projet"];
$nomPlugin=$_POST["nomPlugin"];
$nomChangementPlugin=$_POST["nomChangementPlugin"];
$base1=$_POST["base1"];
$nomChangementPlugin2=$_POST["nomChangementPlugin2"];
$base2=$_POST["base2"];
$nomTable=$_POST["nomTable"];
$description=$_POST["description"];
$titreWidget=$_POST["titreWidget"];

// on vérifie que les différents dossiers existent sinon on les crées
if (!file_exists('../'.$projet))
    mkdir('../'.$projet);
if (!file_exists('../'.$projet.'/wp-content'))
    mkdir('../'.$projet.'/wp-content');
if (!file_exists('../'.$projet.'/wp-content/plugins'))
    mkdir('../'.$projet.'/wp-content/plugins');
if (!file_exists('../'.$projet.'/wp-content/plugins/'.$nomPlugin))
    mkdir('../'.$projet.'/wp-content/plugins/'.$nomPlugin);

$affichage=fopen('../'.$projet.'/wp-content/plugins/'.$nomPlugin.'/'.$nomPlugin.'.php','w');
fputs($affichage , generePlugin($nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$description));

$affichage=fopen('../'.$projet.'/wp-content/plugins/'.$nomPlugin.'/'.$nomPlugin.'Class'.'.php','w');
fputs($affichage ,  generePluginClass($nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$nomTable));

$affichage=fopen('../'.$projet.'/wp-content/plugins/'.$nomPlugin.'/'.$nomPlugin.'widget'.'.php','w');
fputs($affichage ,  generePluginWidget($description,$nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$base1,$base2,$titreWidget));

$affichage=fopen('../'.$projet.'/wp-content/plugins/'.$nomPlugin.'/'.'design.css','w');
fputs($affichage ,  genereDesigncss());

header('Location:index.html');
// ====================================================================//
// ============================fonctions===============================//
// ====================================================================//

function generePlugin($nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$description)
{
    $affichage='
    <?php
    /*
    Plugin Name: '.$nomPlugin.'
    Description: '.$description.'
    Author: Moi
    Version: 1.0
    */
    class '.$nomPlugin.'_plugin
    {
        public function __construct()
        {
            include_once plugin_dir_path(__FILE__) . "/'.$nomPlugin.'Class.php";
            new '.$nomPlugin.'Class();
            register_activation_hook(__FILE__, array("'.$nomPlugin.'Class", "install"));
            register_deactivation_hook(__FILE__, array("'.$nomPlugin.'Class", "uninstall"));
            add_action("admin_menu", array($this, "add_admin_menu"), 20);
        }
        public function add_admin_menu()
        { //on ajoute une page dans le menu administrateur
            add_menu_page("'.$nomPlugin.'", "'.$nomPlugin.'", "manage_options", "'.$nomPlugin.'", array($this, "menu_html"));
        }
        public function menu_html()
        {
            
            echo "<h1>" . get_admin_page_title() . "</h1>";
            ?>

            <h1>Style</h1>
            <!-- <?php        ?>  -->
        
            <form method="post" action="options.php">
            <p>
                <legend>Titre</legend>
            <label>'.$nomChangementPlugin.'</label>
            <input type="text" name="'.$nomPlugin.'_'.$nomChangementPlugin.'" value="<?php echo get_option("'.$nomPlugin.'_'.$nomChangementPlugin.'") ?>"/>
            <label>'.$nomChangementPlugin2.'</label>
            <input type="text" name="'.$nomPlugin.'_'.$nomChangementPlugin2.'" value="<?php echo get_option("'.$nomPlugin.'_'.$nomChangementPlugin2.'") ?>"/>
            </p>
            <?php submit_button();?>
            <?php settings_fields("'.$nomPlugin.'_settings") ?>
            </form><?php
        }
    }
    new '.$nomPlugin.'_plugin();';
    return $affichage;
}
function generePluginClass($nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$nomTable)
{
    $affichage='
    <?php
    //on inclu la definition du widget
    include_once plugin_dir_path(__FILE__) . '."'".'/'.$nomPlugin.'widget.php'."'".';
    class '.$nomPlugin.'Class
    {
        public function __construct()
        {
            // on déclare le widget
            add_action("widgets_init", function () {register_widget("'.$nomPlugin.'widget");});
            // charger le CSS
            add_action("wp_enqueue_scripts", array($this, "persoCSS"), 15);
            // on ajoute l action de sauvegarde au chargement du widget
            add_action("wp_loaded", array($this, "save_comm"));
            //enregistrement de l action
            add_action("admin_init", array($this, "register_settings"));
        }
        public function persoCSS()
        {
            wp_enqueue_style("'.$nomPlugin.'css", plugins_url("'.$nomPlugin.'/design.css"));
        }
        public static function install()
        { 
            //méthode déclenchée à l activation du plug-in
            global $wpdb;
            $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}'.$nomTable.'_commentaire (id INT AUTO_INCREMENT PRIMARY KEY, comm VARCHAR(255) NOT NULL,  pseudo VARCHAR(55) NOT NULL);");
        }
        public static function uninstall()
        { 
            //méthode déclenchée à la suppression du module
            global $wpdb;
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}'.$nomTable.'_commentaire;");
        }
        public function save_comm()
        {
            if (isset($_POST["'.$nomPlugin.'_comm"]) && !empty($_POST["'.$nomPlugin.'_comm"])) {
                global $wpdb;
                $comm = $_POST["'.$nomPlugin.'_comm"];
                $pseudo = $_POST["pseudo"]; 
                $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}'.$nomTable.'_commentaire WHERE comm = '."'".'$comm'."'".'");
                if (is_null($row)) {
                    $wpdb->insert("{$wpdb->prefix}'.$nomTable.'_commentaire", array("comm" => $comm, "pseudo" => $pseudo));
                }
            }
        }
        public function register_settings()
        {
            register_setting("'.$nomPlugin.'_settings", "'.$nomPlugin.'_'.$nomChangementPlugin.'");
            register_setting("'.$nomPlugin.'_settings", "'.$nomPlugin.'_'.$nomChangementPlugin2.'");
        }
    }

    ';
    return $affichage;
}
function generePluginWidget($description,$nomPlugin,$nomChangementPlugin,$nomChangementPlugin2,$base1,$base2,$titreWidget)
{
    $affichage='
    <?php
    class '.$nomPlugin.'widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct("'.$nomPlugin.'", "'.$nomPlugin.'", array("description" => "'.$description.'"));
        }
        public function widget($args, $instance)
        { 
            // formulaire afficher à l écran pour l utilisateur
            // on appel les méthodes standard au cas où un autre plug-in les aurait surchargées
            echo $args["before_widget"];
            echo $args["before_title"];
            echo apply_filters("widget_title", $instance["title"]);
            echo $args["after_title"];
            // corps du widget
            $'.$nomChangementPlugin.' = get_option("'.$nomPlugin.'_'.$nomChangementPlugin.'", "'.$base1.'");
            $'.$nomChangementPlugin2.' = get_option("'.$nomPlugin.'_'.$nomChangementPlugin2.'", "'.$base2.'");
            ?>
            <div id="test" style="'.$nomChangementPlugin.':<?php echo $'.$nomChangementPlugin.'?>; '.$nomChangementPlugin2.':<?php echo $'.$nomChangementPlugin2.' ?>">'.$titreWidget.'</div>
            <form action="" method="post">
            <p>
            <label for="'.$nomPlugin.'_comm" >commentaire :</label>
            <input  id="'.$nomPlugin.'_comm" name="'.$nomPlugin.'_comm" type="texte"/>
            <label for="pseudo">pseudo :</label>
            <input id="pseudo" name="pseudo" type="texte"/>
            </p>
            <input type="submit"/>
            </form>
            <?php
            echo $args["after_widget"];
        }
        public function form($instance)
        // formulaire de gestion des paramètres pour le module d administration
        {
            $title = isset($instance["title"]) ? $instance["title"] : "";
            ?>
            <p>
            <label for="<?php echo $this->get_field_name('."'".'title'."'".'); ?>"><?php _e('."'".'Title:'."'".');
            ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('."'".'title'."'".'); ?>" name="<?php
            echo $this->get_field_name('."'".'title'."'".'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <?php
        }
    }
    ';
    return $affichage;
}
function genereDesigncss()
{
    $affichage="";
    return $affichage;
}