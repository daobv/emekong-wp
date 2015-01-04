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
define('DB_NAME', 'emekong');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '12345');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ',XYUdEs25Y%uz`}M$zAsIWGtEqm,@|UI+tv{{&8q5_-{BQtG|TG)g!-+ZYJ]uE.`');
define('SECURE_AUTH_KEY',  '|6nkH-O?T)3|L|fG@Wx.O:V|z|VoZ7lfG|@gJSx#JLDO,jf*qjL]8G6KCo04d# S');
define('LOGGED_IN_KEY',    'qQ,M qh1+=ND*o!LQ-?M)f9I@(]?-G3$+IKLQk^V)3RX&#-NcbUt+|N# 7l;;[|2');
define('NONCE_KEY',        '!*)Q;U[?>?XJOU-U#`%w*d{X-=i[7pt}96vA#,0t#zGs0&h_}|*NTZoyz]XB%oJ(');
define('AUTH_SALT',        'veq2>c6&_%M[l0GMf,aJ~!y+=JSj*lRJ*]B{(8W|2-S$7}jg9p`bI4{Khiu9#-3^');
define('SECURE_AUTH_SALT', 'x|CN_OW`*~4G8gQmwg +`+6PT-b{O-k`sBll^lf]j$?FX}@h|]#QM/(nX(3ohTc5');
define('LOGGED_IN_SALT',   'KGP1*)<Fs-5zl_nxkQx/wz+*lS<^y.|az bem^{v+k%wvFFUoSi|?0z#XUQZN*mO');
define('NONCE_SALT',       'brkDE2zxRS78|=DNGxJQMHLn#<F:Cr+dJlaC$$js/OEhD]:lYdZ#=Cp8C*$z6QX>');

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
define('WP_DEBUG', TRUE);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
