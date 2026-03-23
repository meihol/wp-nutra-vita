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
define( 'DB_NAME', 'wp_nutravita_d' );

/** Database username */
define( 'DB_USER', 'wp_nutravita_u' );

/** Database password */
define( 'DB_PASSWORD', 'UGQ+0^W=yk' );

/** Database hostname */
define( 'DB_HOST', 'ec2-43-205-168-50.ap-south-1.compute.amazonaws.com' );

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
define( 'AUTH_KEY',          'l.shqF)*cU>fQy/#T7+&*-j%wuPQKdx!hW*2xD$Jl!~$)+mEC^Na]E$:=Qq6h;?*' );
define( 'SECURE_AUTH_KEY',   'g,ZH2T>Y:%p7<2kL/n~S_?qd6[FG$;|(E@am*PAyHSH[c%d>^~^Gp1G`6*0SW0L%' );
define( 'LOGGED_IN_KEY',     '0Tw3,C`=S%jylL[FW(0br+ic0z=9$Hh`GWhZd{whAN5<!Q|fy;_6X_4.]{1A[pek' );
define( 'NONCE_KEY',         'Du8e)nI!#9tub%w1:s,H&TmjxOfR<oZsm#Vq =6dx3oge~2FDyvSqEoCZ{PnJj2Q' );
define( 'AUTH_SALT',         'JPX{<%Wz/+6;ce|hZc-WhVIxh^ 2L-WRpPlse) 29A)N7a.X(b,2,?{]k v@Ay<m' );
define( 'SECURE_AUTH_SALT',  '1s[ULmX<JY1g!XL?n Wuc0c{uX]kyL;M?7k|[]7_Fr}:Cpp[ 7Tr25wH?/W/p.fI' );
define( 'LOGGED_IN_SALT',    'bR+#WQv-!M0.6Q>$xjY{pVl0Rfs^@1d2D[;P$Qj+TrrX swagUiZ4O5{Od$s@dHh' );
define( 'NONCE_SALT',        'O.x5`0Tw;;FPzd4{_W7J!CRfwK;K{.zvoI@@X7ptcW*B[&d2=q`x+788L]P39+P6' );
define( 'WP_CACHE_KEY_SALT', ':!_~Nz~!9)6QfoO+YOjhINC06q=]+)DUtX[|g14yM5#,U0%0eNC57VM?dd3Ne;h)' );


/**#@-*/

/**
 * WordPress database table prefix.
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


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISABLE_WP_CRON' , true );
define( 'DISALLOW_FILE_MODS', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';