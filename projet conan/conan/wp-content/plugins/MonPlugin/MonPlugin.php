<?php
/*
Plugin Name: Mon Plugin
Description:
Author: Moi
Version: 1.0
 */
class MonPlugin_plugin
{
    public function __construct()
    {
        include_once plugin_dir_path(__FILE__) . '/monPluginClass.php';
        new monPluginClass();
        register_activation_hook(__FILE__, array('monPluginClass', 'install'));
        register_deactivation_hook(__FILE__, array('helloclass', 'uninstall'));
        add_action('admin_menu', array($this, 'add_admin_menu'), 20);
    }
    public function add_admin_menu()
    { //on ajoute une page dans le menu administrateur
        add_menu_page('Mon Plugin', 'MON Plugin a moi', 'manage_options', 'monPlugin', array($this, 'menu_html'));
    }
    public function menu_html()
    {
        echo '<h1>' . get_admin_page_title() . '</h1>';
        ?>
        <form method="post" action="options.php">
        <label>Couleur</label>
        <input type="text" name="monPlugin_couleur" value="<?php echo
        get_option("monPlugin_couleur") ?>"/>
        <?php submit_button();?>
        <?php settings_fields('monPlugin_settings') ?>
        </form>
        <?php
}
}
new MonPlugin_plugin();