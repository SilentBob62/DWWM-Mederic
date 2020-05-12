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
            <h3 class="ecritureBlanche">Proposition d'Amélioration du site</h3>
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
        for($a=0;$a<2;$a++)
        {
            if($a==0)echo'<div class="dernierCommentaire"><h3 class="ecritureBlanche">La dernière idée : </h3></div>';
            else echo'<div class="dernierCommentaire"><h3 class="ecritureBlanche">Avant dernière idée : </h3></div>';
            global $wpdb;
            //recupere le dernier id
            $id= $wpdb->get_row("SELECT MAX(id)-$a FROM {$wpdb->prefix}test_idee");

            foreach($id as $unite)
            {
                $unite;
            }
            // recupere le dernier commentaire et le dernier pseudo
            $row = $wpdb->get_row("SELECT pseudo, ideeAmelioration FROM {$wpdb->prefix}test_idee WHERE id = $unite");
            $i=0;
            // ecrit le dernier commentaire
            foreach($row as $unite)
            {
                if($i==0)
                {
                    echo '<p style="font-weight:bolder">'.$unite." a proposer de ".'"';
                    $i++;
                }
                else
                {
                    echo $unite.'"';
                }
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