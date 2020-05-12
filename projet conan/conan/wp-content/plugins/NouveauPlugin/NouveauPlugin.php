<?php
/*
Plugin Name: Nouveau Plugin
Description: commentaire sur salut tout le monde
Author: Moi
Version: 1.0
 */
class NouveauPlugin_plugin
{
    public function __construct()
    {
        include_once plugin_dir_path(__FILE__) . '/nouveauPluginClass.php';
        new nouveauPluginClass();
        register_activation_hook(__FILE__, array('nouveauPluginClass', 'install'));
        register_deactivation_hook(__FILE__, array('nouveauPluginClass', 'uninstall'));
        add_action('admin_menu', array($this, 'add_admin_menu'), 20);
    }
    public function add_admin_menu()
    { //on ajoute une page dans le menu administrateur
        add_menu_page('Nouveau Plugin', 'Nouveau', 'manage_options', 'nouveauPlugin', array($this, 'menu_html'));
    }
    public function menu_html()
    {
        
        echo '<h1>' . get_admin_page_title() . '</h1>';
        ?>

        <h1 style="color:blue; font-weight: bolder;">Style</h1>
        <!-- <?php        ?>  -->
      
        <form style="" method="post" action="options.php">
        <p>
            <legend>Titre</legend>
        <label>Couleur</label>
        <input type="text" name="nouveauPlugin_couleur" value="<?php echo get_option("nouveauPlugin_couleur") ?>"/>
        <label>taille</label>
        <input type="text" name="nouveauPlugin_taille" value="<?php echo get_option("nouveauPlugin_taille") ?>"/>
        </p>
        <?php submit_button();?>
        <?php settings_fields('nouveauPlugin_settings') ?>
        </form>
        <?php
    }
}
new nouveauPlugin_plugin();