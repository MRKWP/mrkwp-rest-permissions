<?php
/**
 * Plugin Name:     MRK Rest Permissions
 * Plugin URI:      https://www.mrkwp.com
 * Description:     MRK Rest Permissions by MRK WP.
 * Author:          MRK WP
 * Author URI:      https://www.mrkwp.com
 * Text Domain:     mrk-rest-permissions
 * Domain Path:     /languages
 * Version:         1.0.1
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

/**
 * The code that runs during plugin activation.
 *
 * @return void
 */
function activate_mrk_rest_permissions_plugin() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_mrk_rest_permissions_plugin' );

/**
 * The code that runs during plugin deactivation.
 *
 * @return void
 */
function deactivate_mrk_rest_permissions_plugin() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_mrk_rest_permissions_plugin' );
/**
 * Remove users from REST
 *
 * @param array $endpoints A string containing the users endpoint.
 *
 * @return array
 */
function mrk_remove_rest_users( $endpoints ) {
	if ( isset( $endpoints['/wp/v2/users'] ) ) {
		unset( $endpoints['/wp/v2/users'] );
	}
	if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
}

if ( ! is_user_logged_in() ) {
	add_filter( 'rest_endpoints', 'mrk_remove_rest_users' );
}
