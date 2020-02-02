<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'quiz1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', '');

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
define('AUTH_KEY',         '[R(Hrm],3^F}z8uY)guCo25(p}~zGnKoD;iH/Vpvu;5>syT|6112[0zR%q?s;gz(');
define('SECURE_AUTH_KEY',  'AW ,0-Zx`/|1h]+Xs:7xIi$|i)I:>k,iA&}PhR-vih=~nZ:R>&Sw-{avxsRGC|Ys');
define('LOGGED_IN_KEY',    '[?_k9k!9_+vY3gq} Z[n_!.Uj9ULwVMY,c!F7wk=^5i}!VK-FX(3;Tmyj3pM?62=');
define('NONCE_KEY',        'c`(^zHSEzVxQEbf5M9m+WY6~sV[q8:BBID$@H3ALdk^~x:}x/2Ycl`_QqdaX 9HL');
define('AUTH_SALT',        'MDNNXCFOh_Q:=8C`kFn3yi#thV3|0)dz- M.gNQDj35L[x|~y>`m&-sxGG&}1kN-');
define('SECURE_AUTH_SALT', '{ Onf(-wrEz*6cM{D:H!B+ngrf?r6.cFm8wBx0[Wp/@Zh-_iY-cLefx>.[+hHX~G');
define('LOGGED_IN_SALT',   'qJ;u4[6)fuc>,}8.a_R;Jm=HlT0.-9T|qdUf56SmYN1xcq7~.!_s#+AawQ4g{M]p');
define('NONCE_SALT',       'n>HyT/Ou}9|~-3-Zh|g{;{.*e(F9q$B-A+{cV }(hQdHm#G&+[qT>1mp-EcQ]-=a');

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

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
