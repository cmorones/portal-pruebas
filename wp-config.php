<?php
/**Servidor de pRUEBA
Nueva modificacion a un archivo
  * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'portal');

/** MySQL database username */
define('DB_USER', 'music_local');

/** MySQL database password */
define('DB_PASSWORD', 'P0rt41.');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`%(c6#/%0AA[LTpPI y-Z`#ap.+[9Y#-|!<y)o-bKgaUF@-vZ|b4Wg?!([7|wDDo');
define('SECURE_AUTH_KEY',  '~&L}vBh9S4Y9mO-*wX]HEHlq%w|z(mVP z?Yk9y:4:H/|}<|q;wtQ>w5`BF;g;6v');
define('LOGGED_IN_KEY',    'F%F&Q!qWPO/#v]R<j7P]{fq:b?5.9N`k/ba| c+v3eK(VWm2A;d%Db)|Xsb_F;b9');
define('NONCE_KEY',        'h0|NksC^Jf|dX-:#V|ch8; nV05V2E*;#NWmJrI>gW2$Q6Jz6f8sB<vH;wInw_|3');
define('AUTH_SALT',        ':(kmXJ-_NhiS,wYlAjb;+3[bkn^)uz(-xudjsZZKQ}BBo4oSL WJ.ro{@^2r1bSB');
define('SECURE_AUTH_SALT', 'S(1SCb8$eH6ipL#yLi+7M%r(G)7tJa69t]kn{}`_M{oC7OF+!{wZc0NtlB#=>lrO');
define('LOGGED_IN_SALT',   'Pve}8]a|)5.Fx%pL~BHXP(LHhI6/SUekbC{+Z 1/md}FTf2!+u$R^,SXpg0cA@(g');
define('NONCE_SALT',       'W:Nm<N+5 frr*Yt-]!M#,@vbBk+5C8%Z-QmfEx:Wzn|w#Lq{;WvV9!wf}25J:-pN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */
define( 'WP_HOME', 'http://prueba.musica.unam.mx/' );
define( 'WP_SITEURL', 'http://prueba.musica.unam.mx' );	
//define( 'WP_CONTENT_URL', 'http://prueba.musica.unam.mx/wp-content' );
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


define( 'FS_METHOD', 'direct');
define( 'FS_CHMOD_DIR', 0777 );
define( 'FS_CHMOD_FILE', 0777 );

