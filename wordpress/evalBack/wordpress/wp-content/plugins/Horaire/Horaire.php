
    <?php
    /*
    Plugin Name: Horaire
    Description: Ce module présentera les horaires de début et fin de chaque période 
    Author: Moi
    Version: 1.0
    */
    class Horaire_plugin
    {
        public function __construct()
        {
            include_once plugin_dir_path(__FILE__) . "/HoraireClass.php";
            new HoraireClass();
            register_activation_hook(__FILE__, array("HoraireClass", "install"));
            register_deactivation_hook(__FILE__, array("HoraireClass", "uninstall"));
            add_action("admin_menu", array($this, "add_admin_menu"), 20);
        }
        public function add_admin_menu()
        { //on ajoute une page dans le menu administrateur
            add_menu_page("Horaire", "Horaire", "manage_options", "Horaire", array($this, "menu_html"));
        }
        public function menu_html()
        {
            
            echo "<h1>" . get_admin_page_title() . "</h1>";
            ?>

            <p style="border:black 1px solid; padding:1vw; width:20vw">Paramétrage</p>
            <p>
                <div class="premierJour">premier jour de la semaine</div> 
                <select name="jour" id="jour">
                    <option value="lundi">lundi</option>
                    <option value="mardi">mardi</option>
                    <option value="mercredi">mercredi</option>
                    <option value="jeudi">jeudi</option>
                    <option value="vendredi">vendredi</option>
                    <option value="samedi">samedi</option>
                    <option value="samedi">dimanche</option>
                </select>
            </p>
            <p>
                <div class="tousJour">Afficher tous les jours</div>
                <input type="checkbox" id="tousJours" name="tousJours">
            </p>
        
            <form method="post" action="options.php">
            <?php settings_fields("Horaire_settings") ?>
            </form><?php
        }
    }
    new Horaire_plugin();