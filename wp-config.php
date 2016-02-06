<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jepheroe_wp');

/** MySQL database username */
define('DB_USER', 'jepheroe_admin');

/** MySQL database password */
define('DB_PASSWORD', 'Vz+6dOXNHFMX');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'TtII_pONfSbZ-a)LW]hWR-/54i<FLGC2phGLBOkGqrw9dS ~=1zXx$]_~X({$|hk');
define('SECURE_AUTH_KEY',  '2G6WX_JL9F=A;2m}%.:#T`m69://Zm+fbb(9*Y3@{|,aA9cA;e|JeP3--CxCs+l@');
define('LOGGED_IN_KEY',    '2{`@0R-dC:B6PKm_-qpOe!>g v@[HWAVb{-Y;zlKrN;#|+XG|vc/s19Fi+.z<1P`');
define('NONCE_KEY',        'jHKi(!kA6SZ44I(Mqhh|L9=SH%Cj7s6#.)1ifF]T|r:n?PV$.b%R zR+=Ry5Png_');
define('AUTH_SALT',        'ztl%5FT.3X0NwDK~DN~jrYOQg,exj!ul|}+g-[[Li+7]P*b.Z!%?:o%;iwXcUb}}');
define('SECURE_AUTH_SALT', ',Vs/w3-:{KeCP{bJ&%|0Ah0+uT@6qcK{WCgXK%JdbcpSD&t?I&ydJ5C=}6bI4lXW');
define('LOGGED_IN_SALT',   'L^_6qorp|YVofDKjkZ~;5_<(wN:`-}LveVPn-+[S6=qUJ_UembQt)h-m5NzLSu+2');
define('NONCE_SALT',       ')yqlC*fY<r|.7soc!dHx,o.vo%#F0y(*eR|OaaaAlp$>&]tqJet>{.U{9gd&u|W%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
