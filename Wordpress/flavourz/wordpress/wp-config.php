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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'flavourz' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9dB}EkizCaE^b+]W7b^siE-V6VPOiF*4GSlCRx%sCC2LS._Hl1=CLA0E$j0]f3>F' );
define( 'SECURE_AUTH_KEY',  'P]N(NMGn#wc)vAH1`yd^OCU_;U0Yn;Zl`dJ5Xb`$(F<bBA1NR-|P;*5 [FC_?fc(' );
define( 'LOGGED_IN_KEY',    'Nb(c,SV]tQ.#v>z3:RT>3Ol3WGz|T(O?v]:~iUoM.kibU(v8W`D9_c)5$0fLrvF4' );
define( 'NONCE_KEY',        '?~!T0w1VZq-hAzHHi$p$5E|gC JS%l8S*T:cD:u}`4~Wzrh$`=ILA&84B!o!ammG' );
define( 'AUTH_SALT',        'EMiOpDm?]z&OX*^y1Td`2A<R{a$/G,^$%c)*6d49&C2=BU#r{=|#BPCPyJyvB{R*' );
define( 'SECURE_AUTH_SALT', '[1QoWU$ PX8#`|E}b%[8LLaG/R8=0Zk%Btdpr 8qU8!SDTU7Y[F+N:CNuB9&PMw ' );
define( 'LOGGED_IN_SALT',   '<,s;sKL+RCuE1I@L&U1Zh3FBgh[Tw4iE3DK^qFRa%T^po(^DSD8~Dvc5W2uO*RP:' );
define( 'NONCE_SALT',       'rT!L]:xEkC2fsn7%aMIy,(qSOhl`nT D@5A,|dQ1_]M}P-`5J~ycD+0!VS;~L1E#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
define('FS_METHOD','direct');


require_once ABSPATH . 'wp-settings.php';
