<?php
/*
Plugin Name: test
Description:
Author: SilentB0B
Version: 1.0
 */
class test_Plugin
{
    public function __construct()
    {
        include_once plugin_dir_path(__FILE__) . '/testClass.php';
        new testClass();
        //active fonction install
        register_activation_hook(__FILE__, array('testclass', 'install'));
        //active fonction desinstall
        register_deactivation_hook(__FILE__, array('testclass', 'uninstall'));
        //menu
        add_action('admin_menu', array($this, 'add_admin_menu'),20);
    }
    public function add_admin_menu()
    { 
        //on ajoute une page dans le menu administrateur
        add_menu_page('test', 'idée amelioration', 'manage_options','test', array($this, 'menu_html'));
    }
    public function menu_html() {
    echo '<h1 style="color:red">'.get_admin_page_title().'</h1>';
    echo '<h2 style="color:green" >Bienvenue sur la page d\'accueil du plugin idée d\'amélioration</h2>';
    
    echo '<p><div class="entete2">Proposition</div></p>';

    global $wpdb;
        
    $infos=($wpdb->get_results("SELECT pseudo, ideeAmelioration FROM {$wpdb->prefix}test_idee")); 
    foreach($infos as $info)
    {
        $i=0;
        foreach($info as $comm)
        {
            if ($i==1){
                echo($comm);
            }
            else
            echo '<p style="font-weight:bolder">'.($comm)." ===> "."\t";
            $i++;
        }
        
    }
    }
}
new test_Plugin();
