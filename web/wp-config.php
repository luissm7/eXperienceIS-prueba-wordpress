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
define('WP_CACHE', false); //Added by WP-Cache Manager

define('DB_NAME', 'experienceprueba');

/** MySQL database username */
define('DB_USER', 'experienceprueba');

/** MySQL database password */
define('DB_PASSWORD', 'experienceprueba');

/** MySQL hostname */
define('DB_HOST', 'mariadb');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'G0C<B%.^s4maQ/Y :]#C29;gNnBcMVsqEM^|4kPZ%k`OSwLogzpaNO{%.=Q.A>,t');
define('SECURE_AUTH_KEY', 'q3| ULt,!U8S:=f*B/okg$a-3]KhNx@~`C(5J%eM/.Cf@N/465ihn xTJfxy<Lie');
define('LOGGED_IN_KEY', ' U#U*v {C [lfLNE||+lb75+Lq]:dkU,3_tm^&x[rWfUpvmzG-!<mrjCnQzSThU~');
define('NONCE_KEY', 'WoK)3KAavg+_&@YEFaQg#]>$ktZNWr?Nicz=`.R%?58|G+uCyA:F*zD`l$6)Z+6M');
define('AUTH_SALT', 'ojkVYonEqq~ZsWumc|q }P?^=*|ss.JTG@2S%q7k.fCkqz~SO{@fI9Q-79v$%i(*');
define('SECURE_AUTH_SALT', 'YqZK:>TlglSPFYIg(NaY2(3mOXf&kv0PB~T]^%0FfN|>ul~rX8@0N$#JY8]wBzNS');
define('LOGGED_IN_SALT', '2f[)dy5dV{+*g*_05I[xcSER?x|(X4+FI04FXF#RY^GG3@2#J50k+8)wFCflpM7K');
define('NONCE_SALT', 'B@//4BS=_.R)!1#9H0]2cirj7|:n4lPy#jMz$E..{vJey~9DWt_2>$?U!|a}*U*Z');

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

// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', true);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', false);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
