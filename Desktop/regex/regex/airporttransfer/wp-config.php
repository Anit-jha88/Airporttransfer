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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_airporttransfer' );

/** Database username */
define( 'DB_USER', 'wordpress_wts' );

/** Database password */
define( 'DB_PASSWORD', 'W0rdpresstheh3llUar3!1?123' );

/** Database hostname */
define( 'DB_HOST', '192.168.2.55' );

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
define( 'AUTH_KEY',         'uYWIGr7Q}oz)QsFHMU)R&jxJ^O&,^Bh,A:6X:+PD0/);9?ori/o H6(SjbY;iWGW' );
define( 'SECURE_AUTH_KEY',  'UiG& h,7W$[V<R@c|1Za`wK<Fsb9Il_1{/rBK.pal43H-H{-9IuX_&&^1ox8e8)<' );
define( 'LOGGED_IN_KEY',    'VvkzhFDSV&)T#>XFKmjlur^>1)>=%! ;.qc}Vr}015z)vc=EckHJzQ2h| *{poY5' );
define( 'NONCE_KEY',        'F.|`b]<Poi{DBhFJ>cQ9+B.Lh;=z$Qv?l~qe >vKL5[eh=yp2*<B6,<{)`Te{#lU' );
define( 'AUTH_SALT',        'j6z.oz<+l.I=`iYqZX%P8O]}[N.^E<sb#c;e.!Z7yz91y{`~+^5d_Dw.94Lj=r_>' );
define( 'SECURE_AUTH_SALT', '()x,,(9bipnv~gi&9{C(t?Gvb<j:d)x^GQpN8:_p/Di?9-,Qt$nSPV,YhTms@u~v' );
define( 'LOGGED_IN_SALT',   'IOa^-mF{,xiWK@qv:5W?X= l@DaC^Nk1&v>(=U%=Y=DV`=Ygm9d6gh3$w9fKk]e_' );
define( 'NONCE_SALT',       '<&=g-X6T3BPf;9jY,&wao]n fe4zx,K-Fvvyl-OH>O<yO0A1~IF2P&0wOV~x#UP-' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wtswp_';

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
define('DISABLE_WP_CRON', true) ;
