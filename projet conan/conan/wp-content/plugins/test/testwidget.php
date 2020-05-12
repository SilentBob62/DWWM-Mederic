<?php
class testwidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('test', 'test', array('description' => 'Un plug-in simple', ));
    }
    public function widget($args, $instance)
    { 
        // formulaire afficher à l'écran pour l'utilisateur
        // on appel les méthodes standard au cas où un autre plug-in les aurait surchargées
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        // corps du widget
        ?>
        <div class="formule">
        <form action="" method="post">
            <h3 class="ecritureBlanche">Proposition d'Amélioration</h3>
            <p>
                <label class="ecritureBlanche" for="test_pseudo">Votre pseudo :</label>
                <input id="test_pseudo" name="test_pseudo" type="texte"/>
            </p>
            <p>
                <label class="ecritureBlanche" for="test_nouvelleIdee">Votre idée Amelioration :</label>
                <input id="test_nouvelleIdee" name="test_nouvelleIdee" type="texte"/>
            </p>
            <input type="submit"/>
        </form>
        <div class="commantaire">
            <?php
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
            ?>
        </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
    public function form($instance)
    // formulaire de gestion des paramètres pour le module d'administration
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' );
        ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php
        echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
}