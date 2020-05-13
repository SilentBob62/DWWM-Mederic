
    <?php
    //on inclu la definition du widget
    include_once plugin_dir_path(__FILE__) . '/Horairewidget.php';
    class HoraireClass
    {
        public function __construct()
        {
            // on déclare le widget
            add_action("widgets_init", function () {register_widget("Horairewidget");});
            // charger le CSS
            add_action("wp_enqueue_scripts", array($this, "persoCSS"), 15);
            // on ajoute les jours 
            add_action('wp_loaded', array($this, 'horairejour'));
            //enregistrement de l action
            add_action("admin_init", array($this, "register_settings"));
        }
        public function persoCSS()
        {
            wp_enqueue_style("Horairecss", plugins_url("Horaire/design.css"));
        }
        public static function install()
        { 
            //méthode déclenchée à l activation du plug-in
            global $wpdb;
            $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}monhoraire (id INT AUTO_INCREMENT PRIMARY KEY, jour VARCHAR(25) NOT NULL,  horaireMatin VARCHAR(55) NOT NULL,  horaireAprem VARCHAR(55) NOT NULL);");
        }
        public function horairejour()
        {
            global $wpdb;
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'lundi', 'horaireMatin' => '8h30-12h30', 'horaireAprem' => '13h30-17h30'));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Mardi ', 'horaireMatin' => '8h30-12h30', 'horaireAprem' => ''));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Mercredi ', 'horaireMatin' => '8h30-12h30', 'horaireAprem' => '13h30-17h30'));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Jeudi', 'horaireMatin' => 'Fermeture', 'horaireAprem' => ''));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Vendredi ', 'horaireMatin' => '8h30-12h30', 'horaireAprem' => '13h30-17h30'));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Samedi ', 'horaireMatin' => '', 'horaireAprem' => '13h30-17h30'));
            $wpdb->insert("{$wpdb->prefix}monhoraire", array('jour' => 'Dimanche ', 'horaireMatin' => '8h30-12h30', 'horaireAprem' => ''));

        }
        public static function uninstall()
        { 
            //méthode déclenchée à la suppression du module
            global $wpdb;
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}monhoraire;");
        }
        public function register_settings()
        {
            register_setting('monPlugin_settings', 'jour');
            register_setting('monPlugin_settings', 'tousJours');
        }
    }

    