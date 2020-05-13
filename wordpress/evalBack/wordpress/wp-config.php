<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'evalBack' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', '127.0.0.1:3308' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'sO*E)j$,(fzdYijpX&B}]x9RVJDl:m3SlrX1t||{*WiiP&XU{kFCjs7QK.zwxj|*' );
define( 'SECURE_AUTH_KEY',  'M|/|5$Yb/ZAO8d)LFL3;G4Wo*{:O0In imNg7+HWfju~m>VLVXSS^*I*i=D&el|;' );
define( 'LOGGED_IN_KEY',    'J)f*%83qx4Ex/WR4OR^jqHC$m/$Ah=/ntN[tpL8hh:0q *f5KnY8vl!lYtKqjp8Q' );
define( 'NONCE_KEY',        'pRX)2Vs6hv+UvrbB`N<oX{Ya@(r4]3_[%Pph1{N-v~J;8*,tB<wC&~akyC.R{:(O' );
define( 'AUTH_SALT',        '_!~9JM1%}#T&:<z>z V_d5X4VUhNuj`ws1<jc9ZiQ2>;Ch0-SGbGOiiP47mGAqC8' );
define( 'SECURE_AUTH_SALT', '{a-~OQ-tM`n+!LTzyyi:T)DDpjNte>ABFlugfwcCME8T*[Rahtu6,Y:_S8RVNK/?' );
define( 'LOGGED_IN_SALT',   'I[HmQ9nz2?Msu/vH7-m#~j3.wTo&mYB_5J[{u`d6S`!]qgt5)WHBY{9OS$Q)-<Vh' );
define( 'NONCE_SALT',       '.@O)n9(VppJ2.mH=LLj<xRR8u}$cX||{A-==RAuPFNioi`~(b# UAW0g$@tpdGgO' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp6_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
