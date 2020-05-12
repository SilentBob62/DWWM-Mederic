<?php
/*
Plugin Name: Mon Plugin
Description: commentaire sur salut tout le monde
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
        register_deactivation_hook(__FILE__, array('monPluginClass', 'uninstall'));
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

        <h1 style="color:blue; font-weight: bolder;">Style</h1>
        <!-- <?php        ?>  -->
      
        <form style="border:black 2px solid;  background-color: rgba(0, 0, 0, 0.5); border-radius: 10px; padding:1vw;width:50vw" method="post" action="options.php">
        <p>
            <legend style="font-weight: bolder;color:rgb(114, 17, 17)">Titre</legend>
        <label style="font-weight: bolder">Couleur</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_couleur" value="<?php echo get_option("monPlugin_couleur") ?>"/>
        <label style="font-weight: bolder">taille</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_taille" value="<?php echo get_option("monPlugin_taille") ?>"/>
        </p>
        <p>
            <legend style="font-weight: bolder;color:rgb(114, 17, 17);">Commentaire</legend>
        <label style="font-weight: bolder">Couleur</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_couleurCom" value="<?php echo get_option("monPlugin_couleurCom") ?>"/>
        <label style="font-weight: bolder">taille</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_tailleCom" value="<?php echo get_option("monPlugin_tailleCom") ?>"/>
        </p>
        <p>
            <legend style="font-weight: bolder;color:rgb(114, 17, 17);">couleur input</legend>
        <label style="font-weight: bolder">ecriture</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_couleurEcritureInput" value="<?php echo get_option("monPlugin_couleurEcritureInput") ?>"/>
        <label style="font-weight: bolder">fond</label>
        <input style="border:black 2px solid;  background-color: rgb(221, 220, 128);; " type="text" name="monPlugin_couleurFondInput" value="<?php echo get_option("monPlugin_couleurFondInput") ?>"/>
        </p>
        <?php submit_button();?>
        <?php settings_fields('monPlugin_settings') ?>
        </form>
        <h2 style="color:red">liste des commentaires :</h2> 
        <?php
       

        global $wpdb;
        
        $infos=($wpdb->get_results("SELECT pseudo, comm FROM {$wpdb->prefix}mon_commentaire")); 
        foreach($infos as $info)
        {
            $i=0;
            foreach($info as $comm)
            {
                if ($i==1){
                    echo($comm);
                }
                else
                echo '<p style="font-weight:bolder ;border:2px solid red; width:20vw">'.($comm)." : "."\t";
                $i++;
            }
            
        }

    }
}
new MonPlugin_plugin();