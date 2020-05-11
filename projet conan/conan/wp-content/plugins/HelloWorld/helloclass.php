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
        add_action('wp_enqueue_scripts',array($this,'persoCSS'),15);
    }
//fonction pour lier le css (dans la classe mais pas dans le construct)
function persoCSS()
{
wp_enqueue_style('Hellocss', plugins_url('helloworld/design.css'));
}
}
