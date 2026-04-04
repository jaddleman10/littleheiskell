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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '|KmxKn5dS4,#yF`#jGgY4rhE&8y2$.(&!uvM_EMh}Bp*rL(I48%s*vcZux=F_&FO' );
define( 'SECURE_AUTH_KEY',   ';>IR73?VRiowSuz=dp;-g,rG^BA6Rt_ei6lFR7Pq3dd-tmn%BsV&9#(!0I25%L5t' );
define( 'LOGGED_IN_KEY',     'DZ=kJY[M+n{^R8u2W3nzu6>gM<{${Uq8>oqM5f+.N.:M$^Ba:>lR{<{423/D4ACF' );
define( 'NONCE_KEY',         'Wv$RdZMmN:W7#XP~j)`1^8rIEA[pai.5or`IE:T[>9K%r33E~t|d6R(3y}T.`w7M' );
define( 'AUTH_SALT',         '9$,4mZ(8VC2AKMX6aC<hPcHoV8!6^(x$>2VnILZ;CUt?;h~%mNr8l!5i%d&BCW]o' );
define( 'SECURE_AUTH_SALT',  'm[pmjTNT,rz0G!P90]%tG:kVuQZvxf-k3b3uZ-F`|Ix5=O5_yZiIvE`{$WA6>v7/' );
define( 'LOGGED_IN_SALT',    ':n9-5EU+Pv%H|Z.pm;>rc&LUB`YH975Q}WK)k[o$jw]+kLIT<nqN{*F63=OA#[#N' );
define( 'NONCE_SALT',        'e!!:18x|oAhAF?[/c|(:fKxBJ/<Wq~#3BU+;HIi63y$(xTt9{5+2D(8lU}l=O}MQ' );
define( 'WP_CACHE_KEY_SALT', 'w{E4cGaDIq^Cr(akm}wL3}@)i|a/=1=xe47=5tm9mV)2oY)E/vat(]zS*T;CL-<X' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
