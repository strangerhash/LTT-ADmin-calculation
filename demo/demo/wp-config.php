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
define( 'DB_NAME', 'demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'AX4iw7Mo>L-NSw?6mgtf!F^1?(uCOz<Z<@.b>_Ay~(SaiOU6e#88{zSS;g[yOG(1' );
define( 'SECURE_AUTH_KEY',  'JS $2}bt>87)P![ei)w>j=7%lDi&0EoBz*x!y!TQ_/W`+&&i,nvtSoW`.d+Z:l:e' );
define( 'LOGGED_IN_KEY',    'sS p1V(s!hvi:c_P8Z_&{g8^RgD^5P0~!7bDH48b(OgJl<1A]zQ_D#lo|/A:)V5|' );
define( 'NONCE_KEY',        'bfgZhJnIhc!}4S+i7z^Q_.h>)PfP&1DaKO(+eBQ#@.&,Xg&pZ_/>eHupNS=nvk.D' );
define( 'AUTH_SALT',        'o&H[K<&8l(N5hO,&+X~;I~OJ`P-*Ayr7hKl9kkL;1fDTOVg[-!|bhrZG5(#|N^n/' );
define( 'SECURE_AUTH_SALT', 'aMr p%9?`8+kZQ2FO;x,<f[Bb@g|:SxHw.d2IloP~}X%E?zV`<CG:i`f=B, !ei>' );
define( 'LOGGED_IN_SALT',   '.0*THsY`Gq;^Q*3;HkUjw2dNo9|D#dw[G?iT[ua;+?vNdOI~Y7!lU2*KY.I,A%(X' );
define( 'NONCE_SALT',       '@[?-~/Vi v?l~1;4-;>$+xLBYdPD)8wHi4 kF$%hQsM!2RvX_Lkq>B%@{M/2G1`)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'demo_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
