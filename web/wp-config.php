<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/rwandaspecial/public_html/web/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'rwandaspecial_web' );

/** Database username */
define( 'DB_USER', 'rwandaspecial_wp_qqhcb' );

/** Database password */
define( 'DB_PASSWORD', '@$bP$!~rX5dn~Z36' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '!ej/VF-%4BJNqght8*)85&vJ20n9D239A[bp7AfTu~o1Tdr-r+dc34H!5dYc+0iE');
define('SECURE_AUTH_KEY', 'UY4SGkmn3KrI_2G_NUOdB9YY!v:ZqvKHuyOXK26eJ%WS#EtE4E]p8AI2g2+~#u4!');
define('LOGGED_IN_KEY', 'Uw+Sr@C)#02+yMdF|lz*5ee0i(4y3Bu~ya#1f/;dP@Sm*2I]zE%-8S3h1IP(9B]8');
define('NONCE_KEY', '878fXr2L2;T0xO|f43;3tCi7)0W94*&*#516vo10@UoOs65~10f2rpekN_iy|feO');
define('AUTH_SALT', '9~K3d:GqIUwL67yw~leUN~Z2|7&y:V7jOjDZ6[@6w1gPOa08(D854iQ!BT0#sw19');
define('SECURE_AUTH_SALT', 'Yw67Y7/&]:b+MCk4BHa%m~1n!l5v:P0osZI|8M06x#J453lU7-921i5C39!)K_m:');
define('LOGGED_IN_SALT', '8n&-MS@7_Df~il;5tB2)2~n0g&f162J75qg39jZS77I3edzEG%j6ccm:j9s1|328');
define('NONCE_SALT', 'l33)[9&o|I54tx65DWc#!P%1Mb#t3tBMeu52tq+I%Xm@oP#j]5+P_HOP59Vpu-C@');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'webtable';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
