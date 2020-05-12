<?php
//on inclu la definition du widget
include_once plugin_dir_path(__FILE__) . '/testwidget.php';
class testClass
{
    public function __construct()
    {
        // on déclare le widget
        add_action('widgets_init', function () {register_widget('testWidget');});
        //charger le CSS
        add_action('wp_enqueue_scripts', array($this, 'persoCSS'), 15);
        // on ajoute l'action de sauvegarde au chargement du widget
        add_action('wp_loaded', array($this, 'save_ideeAmelioration'));
    }
    public function persoCSS()
    {
        wp_enqueue_style('testcss', plugins_url('test/design.css'));
    }
    public static function install()
    {
        //méthode déclenchée à l'activation du plug-in
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}test_idee (id INT AUTO_INCREMENT PRIMARY KEY, ideeAmelioration VARCHAR(255) NOT NULL, pseudo VARCHAR(25) NOT NULL);");
    }
    public static function uninstall()
    {
        //méthode déclenchée à la suppression du module
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}test_idee;");
    }
    public function save_ideeAmelioration()
    {
        if (isset($_POST['test_nouvelleIdee']) && !empty($_POST['test_nouvelleIdee'])) {
            global $wpdb;
            $ideeAmelioration = $_POST['test_nouvelleIdee'];
            $pseudo = $_POST['test_pseudo'];
            $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}test_idee WHERE ideeAmelioration = '$ideeAmelioration'");
            if (is_null($row)) {
                $wpdb->insert("{$wpdb->prefix}test_idee", array('ideeAmelioration' => $ideeAmelioration,'pseudo' => $pseudo));
            }
        }
    }
}
