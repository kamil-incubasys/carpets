<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'carpets');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Memory Limit, changed for WooCommerce */
define( 'WP_MEMORY_LIMIT', '64M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{u&w`dqcH=Q)f|s[rb/&Ej4;&E:(4^pTE[+-}pQaI;b!m4;|%vF>wjEPru{~O5R(');
define('SECURE_AUTH_KEY',  '+H4$Qj$4B6X/aawdVEUi~SH`mN&8$[AkCC067;;Yse~,^[DiH&5^u;P+50fWCp?,');
define('LOGGED_IN_KEY',    'c+EX_Zz1.AT=2H[Qm:y#^}oHLps:~s38eFqZA5 )a!b8X=gR>LGYUd7.f0O},TqJ');
define('NONCE_KEY',        'E62~zUM4zH0&RSt+X-N#!S;|f79F}1~0zqIl91xFYp>2ZOf]TM*)[MDtua}eD:,`');
define('AUTH_SALT',        'g57;D0b#]$5%1y^3 +a]?hD<&|vg$zQ*v=X`$oX+a{I;znpa6qoZ1t}C^07hJ6-A');
define('SECURE_AUTH_SALT', 'L$MXl uAU+e/Rk6 2h}4$o+mZA`(uMv0Fbl++:Dl[~uk>%m2HYD:]G,qx15-&t8C');
define('LOGGED_IN_SALT',   '-f+vG1} F5!R/qSjzndQr{huG}bNv8R%-`mv[Z;b!?^6 J+9F&aJXm#FUHT.z=rv');
define('NONCE_SALT',       '3m+~#I-X2^kfP*}K=FEz:ie?f6z+Z%(MhCe:X:i;cM0$N?~jFi/E84xoH`5v?JK`');

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
