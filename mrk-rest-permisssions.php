<?php
/**
 * Plugin Name:     MRK Rest Permissions
 * Plugin URI:      https://www.mrkwp.com
 * Description:     MRK Rest Permissions by MRK WP.
 * Author:          MRK WP
 * Author URI:      https://www.mrkwp.com
 * Text Domain:     mrk-rest-permissions
 * Domain Path:     /languages
 * Version:         1.0.0
 * PHP version:     8.3
 *
 * @category Plugin
 * @package  MRK_Rest_Permissions
 * @author   Matt Knighton <matt@mrkwp.com>
 * @license  GPL 2.0 https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     https://www.mrkwp.com
 */

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'No Access!' );

define( 'MRK_REST_PERMISSIONS_PLUGIN_VERSION', '1.0.0' );

define( 'MRK_REST_PERMISSIONS_PLUGIN_FILE', __FILE__ );
define( 'MRK_REST_PERMISSIONS_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR );

// Require once the Composer Autoload.
if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	include_once __DIR__ . '/lib/autoload.php';
}

/**
 * The code that runs during plugin activation.
 *
 * @return void
 */
function activate_mrk_rest_permissions_plugin() {
	MRK_Rest_Permissions\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mrk_rest_permissions_plugin' );

/**
 * The code that runs during plugin deactivation.
 *
 * @return void
 */
function deactivate_mrk_rest_permissions_plugin() {
	MRK_Rest_Permissions\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mrk_rest_permissions_plugin' );

/**
 * Initialize all the core classes of the plugin.
 */
if ( class_exists( 'MRK_Rest_Permissions\\Init' ) ) {
		MRK_Rest_Permissions\Init::register_services();
}
