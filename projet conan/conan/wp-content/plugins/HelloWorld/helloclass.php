<?php
//on inclu la definition du widget
include_once plugin_dir_path(__FILE__) . '/hellowidget.php';
class HelloClass
{
    public function __construct()
    {
        // on déclare le widget
        add_action('widgets_init', function () {register_widget('HelloWidget');});
        // charger le CSS
        add_action('wp_enqueue_scripts', array($this, 'persoCSS'), 15);
        // on ajoute l'action de sauvegarde au chargement du widget
        add_action('wp_loaded', array($this, 'save_comm'));
        //enregistrement de l'action
        add_action('admin_init', array($this, 'register_settings'));
    }
//fonction pour lier le css (dans la classe mais pas dans le construct)
    public function persoCSS()
    {
        wp_enqueue_style('Hellocss', plugins_url('helloworld/design.css'));
    }
    public static function install()
    { //méthode déclenchée à l'activation du plug-in
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}helloworld_commentaire (id INT AUTO_INCREMENT PRIMARY KEY, comm VARCHAR(255) NOT NULL);");
    }
    public static function uninstall()
    { //méthode déclenchée à la suppression du module
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}helloworld_commentaire;");
    }
    public function save_comm()
    {
        if (isset($_POST['helloworld_comm']) && !empty($_POST['helloworld_comm'])) {
            global $wpdb;
            $comm = $_POST['helloworld_comm'];
            $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}helloworld_commentaire WHERE comm = '$comm'");
            if (is_null($row)) {
                $wpdb->insert("{$wpdb->prefix}helloworld_commentaire", array('comm' =>
                    $comm));
            }
        }
    }
    public function register_settings()
    {
        register_setting('helloworld_settings', 'helloworld_couleur');
        register_setting('helloworld_settings', 'helloworld_size');
    }
}
