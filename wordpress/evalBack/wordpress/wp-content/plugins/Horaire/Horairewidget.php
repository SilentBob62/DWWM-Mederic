
    <?php
    class Horairewidget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct("Horaire", "Horaire", array("description" => "Ce module présentera les horaires de début et fin de chaque période "));
        }
        public function widget($args, $instance)
        { 
            // formulaire afficher à l écran pour l utilisateur
            // on appel les méthodes standard au cas où un autre plug-in les aurait surchargées
            echo $args["before_widget"];
            echo $args["before_title"];
            echo apply_filters("widget_title", $instance["title"]);
            echo $args["after_title"];
            $jour = get_option('jour', 'lundi');
            // corps du widget
            ?>
            <div id="test">HORAIRES</div>
            <p><?php
            global $wpdb;
            $id=($wpdb->get_results("SELECT MIN(id) FROM {$wpdb->prefix}monhoraire WHERE jour = '$jour'"));
            // var_dump($id);
            foreach($id as $id1)
            {
                foreach ($id1 as $id)
                {
                    $id;
                }
                
            }
            $infos=($wpdb->get_results("SELECT jour, horaireMatin, horaireAprem FROM {$wpdb->prefix}monhoraire WHERE id = $id"));
            // var_dump($infos);
            foreach ( $infos as $info)
            {
                foreach($info as $jour)
                {
                    echo $jour.' ';
                }
            }
            ?>

                    
            <?php
            echo $args["after_widget"];
        }
        public function form($instance)
        // formulaire de gestion des paramètres pour le module d administration
        {
            $title = isset($instance["title"]) ? $instance["title"] : "";
            ?>
            <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:');
            ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <?php
        }
    }
    