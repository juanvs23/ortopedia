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
define( 'DB_NAME', 'ortoppedia' );

/** MySQL database username */
define( 'DB_USER', 'phpmyadmin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'juan123!' );

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
define( 'AUTH_KEY',         ',XZ$Tp+c{:?6V=&Q{B*+C)I~KCBkv{++.R]KPb,!D_Vs%ev eqxtiDmcG?>:HPk/' );
define( 'SECURE_AUTH_KEY',  '0/@1(aU:<P,@KO@SVhhAk;O{z78m Q.:3d;zPQ[#^<SAl3(=y5zIQqf*SxG`.c$_' );
define( 'LOGGED_IN_KEY',    '72pFDTz3e8u`~K@(~8Ax.t=W*N:|0)6-u7P=IL6P1E6@Xn!JNgkO~W(tt.>gOUf{' );
define( 'NONCE_KEY',        '(F1y#le&%=Tq.,cq@_*jNDG1RxQ:)A?@7B. ``Eu^_$Le38|LzS,|uI]D}!o  e!' );
define( 'AUTH_SALT',        '/xYC_`+kfS~C+NEzGJ20HH}hxbH$ Nym&.O%)7#5av<PvP[fU91$OhFV:Xgz<_o1' );
define( 'SECURE_AUTH_SALT', 'pO,*^}Hm;yoh A3bBji`@;Y-RJN6M,!qevHTh9Z_AdXP_vb%1j0B!-rzF>bq OU=' );
define( 'LOGGED_IN_SALT',   'H]uAC+>&Hey4/7%FDSNntxYp4ZU{6$9,ianW0S[PS3!a#a%^v^<H%rcY1/<XGZP:' );
define( 'NONCE_SALT',       'x4,gs@H.W0!e-<~c:uRv h_,rZ-:lL(@a?2W`YCtXBgS^SuC1f|puj_ ^NDxfZlt' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'elorto200K_';

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
define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
