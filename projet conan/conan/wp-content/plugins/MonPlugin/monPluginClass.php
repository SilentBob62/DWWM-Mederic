<?php
//on inclu la definition du widget
include_once plugin_dir_path(__FILE__) . '/monPluginwidget.php';
class monPluginClass
{
    public function __construct()
    {
        // on déclare le widget
        add_action('widgets_init', function () {register_widget('monPluginwidget');});
         // charger le CSS
        add_action('wp_enqueue_scripts', array($this, 'persoCSS'), 15);
        // on ajoute l'action de sauvegarde au chargement du widget
        add_action('wp_loaded', array($this, 'save_comm'));
        //enregistrement de l'action
        add_action('admin_init', array($this, 'register_settings'));
    }
    public function persoCSS()
    {
        wp_enqueue_style('monPlugincss', plugins_url('MonPlugin/design.css'));
    }
    public static function install()
    { //méthode déclenchée à l'activation du plug-in
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}mon_commentaire (id INT AUTO_INCREMENT PRIMARY KEY, comm VARCHAR(255) NOT NULL,  pseudo VARCHAR(55) NOT NULL);");
    }
    public static function uninstall()
    { //méthode déclenchée à la suppression du module
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mon_commentaire;");
    }
    public function save_comm()
    {
        if (isset($_POST['monPlugin_comm']) && !empty($_POST['monPlugin_comm'])) {
            global $wpdb;
            $comm = $_POST['monPlugin_comm'];
            $pseudo = $_POST['pseudo']; 
            $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}mon_commentaire WHERE comm = '$comm'");
            if (is_null($row)) {
                $wpdb->insert("{$wpdb->prefix}mon_commentaire", array('comm' => $comm, 'pseudo' => $pseudo));
            }
        }
    }
    public function register_settings()
    {
        register_setting('monPlugin_settings', 'monPlugin_couleur');
        register_setting('monPlugin_settings', 'monPlugin_taille');
        register_setting('monPlugin_settings', 'monPlugin_couleurCom');
        register_setting('monPlugin_settings', 'monPlugin_tailleCom');
        register_setting('monPlugin_settings', 'monPlugin_couleurEcritureInput');
        register_setting('monPlugin_settings', 'monPlugin_couleurFondInput');

    }
}
