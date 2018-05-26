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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ul+M7k+V+c/AMCTyi/vchjom1pgkg6DSvL4IQqidEgZnE1XUvw+aGuq0NGViUjbeq0Lc+zVePQr85wTYwwFfEg==');
define('SECURE_AUTH_KEY',  'HeF+32OUDT7EWoixHVPtHvwo+sEB/tXyGzoDPBDMYc9B5QstsrtIVTnQlBNGukjIVvPXlinC8CKUnRWqnHgHMA==');
define('LOGGED_IN_KEY',    'pGXWUNjB3VwBzbQaZ8AbduqyuaZ+PzJva11hH0P6lqUolqvUaElRJVgaVsjTtbPMZtQP6BHJk5Z82uC5Guq9aA==');
define('NONCE_KEY',        'j4kKqMSU184qunUJsx2hrqK1e9jNxo493tSjywz+PSkFzf8LrRZpWgfdHqbERSydSBHyWhf1ClgYeMQ3xkzzlQ==');
define('AUTH_SALT',        '7gXR/TBMqmfal6MLH7oU++ycpXsmoO043oIuR1TC8sWNdwZAx109R5lXKkcSMl628BIFdhDqXuPQtzjn3DkCDw==');
define('SECURE_AUTH_SALT', 'IwRAFNbpoSuMtvSpfrhic4eJ/ooLQ1lfRbQMX+T4AkN7QuC0aDx70kQLc5kXz5C+hnigpMuKxRxnghCnj9UTqA==');
define('LOGGED_IN_SALT',   '/bc70a0EZC1vPgMis4yqaqgfp4y4rZCBJy0TdwogOkh0sa96uFgUaNhbdtEVzTTRdEh3GtbOfsgqJqPEGyV1ag==');
define('NONCE_SALT',       'kw5+GQvbDQ/FARoAk9QgFpFNDZvUQUHgWxWr/j4h92D2UetBBckdRDlVBnLG29SWwv+iz6BEDkX2Uu3nW9crQg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
