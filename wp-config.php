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
define('DB_NAME', 'cungcaphoahuongduong');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'hvY=Ww;bj5s.{c^(7[Cz.j /CUb,!>{@qtpT(mol9CT~@.)Kx>3n#/J+pQ2!uz^0');
define('SECURE_AUTH_KEY',  'OJiA rA-yymgk3KBf:ZdY|@pc=Hz;?.$E:A8;Lpqa$a4k>g,*A/{?O;zWVI^5V?(');
define('LOGGED_IN_KEY',    '(Kz$<X;D<O8:7/2j9`@?+d5cvQK<Q[N@QB(|DBy M.j~me[#!IwD-2qx*S]Y#~Uh');
define('NONCE_KEY',        ')B)9 _ g.TnH7AoGa?s9w{Aa^pnFC@&AHolwz(%q9qtER?P4)#te]y9umD@}dOGt');
define('AUTH_SALT',        '!NE3J;XM,S|[g0!iKxo_?L(In|v.`o:nqy9_x.HZ4Q?+*G&P:PJb.TCE.:@T]I6J');
define('SECURE_AUTH_SALT', 'ETLRO#*yxtEBnuSu)Ho)8nv2R]k6C-5T}&9P18PRB]-wt{^n]Dl:tSZKU~V?b&=c');
define('LOGGED_IN_SALT',   '{Wmh]l5e]2yQgNBT9>Gz$sZBX7%oT%[vQIpBT<nHpxsh$X<^Cf~/x ]|if6)t8CU');
define('NONCE_SALT',       ';`baj9H&xpfVfy~bv4/na(]@`yG%|N;P?MLs7I4@,)H2=];bM.~F-~4_]761P&}d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
