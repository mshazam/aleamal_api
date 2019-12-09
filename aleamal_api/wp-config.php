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
define( 'DB_NAME', 'mrj0909_aleamalpk' );

/** MySQL database username */
define( 'DB_USER', 'mrj0909_aleamal' );

/** MySQL database password */
define( 'DB_PASSWORD', '}a&QKh5mb^%9' );

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
define( 'AUTH_KEY',         'k89W3DM1.OM# {*[76jXZp`a>Slf67M41>.o2q}Q0%5hYb.acu/iXj:}S^s]7i{I' );
define( 'SECURE_AUTH_KEY',  '*!n?(a52ekt!WX8?kQ<=%r(mz*C:LV_3<Pv])y_<}!|r:rmh%3C{JU?{r]0:8,8F' );
define( 'LOGGED_IN_KEY',    'e.9Psh_y`a]PVOHy[*}%w|s+Jncnx,kLd:,A}jxH$R:!fA}B&3MJsp6M&&>pg&LI' );
define( 'NONCE_KEY',        'nCP!=}n47D.@8;_#hloGh&Igo>.Gn`M1Ya7>_G4okcl5Wk)lztwrj5.qT8$n6WS1' );
define( 'AUTH_SALT',        ']*rP3xd`T?[&T.#&H^B6A6ZdPP~VZ65p}n|Cf2WXjtyk*xM?WIb};udVm1#;6CRN' );
define( 'SECURE_AUTH_SALT', '!&R4IzpPGDdw!{Ez02lC[K7xlJ{<P.O-u10W-eW/lUB42:tdw|GU/#X=t|F3QPJO' );
define( 'LOGGED_IN_SALT',   'OI#cw+QaQvnn|s;&iJ<|VLFc-!^Gev=6m=<Uep]H&3YqRJkz>bLuNz^dE>eMH5OP' );
define( 'NONCE_SALT',       'l@8O9D=[ZmB?mU!$>uiFC.A}=ys;@Finpj9:k}U}}G1#gZe`|A%MP1kml0,X/LS2' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
