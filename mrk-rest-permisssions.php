<?php
/**
 * Plugin Name:     MRK Rest Permissions
 * Plugin URI:      https://www.mrkwp.com
 * Description:     MRK Rest Permissions by MRK WP.
 * Author:          MRK WP
 * Author URI:      https://www.mrkwp.com
 * Text Domain:     mrk-rest-permissions
 * Domain Path:     /languages
 * Version:         1.0.2
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
 * Permission Callback to throw a 403 error on rest API for user endpoints.
 * Use Edit Post capability to ensure Gutenberg / Block Editor works as expected.
 *
 * @param [type] $existing_callback // The existing callback for permission on REST Endpoint.
 * @return callback function.
 */
function mrk_permission_callback_hardener( $existing_callback ) {
	return function ( $request ) use( $existing_callback ) {
		return new WP_Error(
			'rest_user_cannot_view',
			__( 'Sorry, you are not allowed to access users.' ),
			array( 'status' => rest_authorization_required_code() )
		);
	};
}

/**
 * Add permission to all user endpoints inside REST API.
 *
 * @param array $endpoints A string containing the users endpoint.
 *
 * @return array
 */
function mrk_add_permission_rest_users( $endpoints ) {
	if ( isset( $endpoints['/wp/v2/users'] ) ) {
		// Get permission callback part from rest object endpoint.
		$users_get_route = &$endpoints['/wp/v2/users'][0];

		// Bind new permission to users endpoint to create 403 if not logged in.
		$users_get_route['permission_callback'] = mrk_permission_callback_hardener( $users_get_route['permission_callback'] );
	}
	if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
		// Get permission callback part from rest object endpoint.
		$user_get_route = &$endpoints['/wp/v2/users/(?P<id>[\d]+)'][0];

		// Bind new permission to user/id endpoint to create 403 if not logged in.
		$user_get_route['permission_callback'] = mrk_permission_callback_hardener( $user_get_route['permission_callback'] );
	}
	return $endpoints;
}

/**
 * Initialise the tool and add end point when user cannot edit posts.
 * Need to use INIT as current_user_can always returns false when called over rest API context.
 * Will then run the additional code to edit the rest endpoints ONLY when a user has not edit permissions.
 *
 * @return void
 */
function mrk_auth_rest_endpoints() {
	// check if function exists as its pluggable.
	if ( function_exists( 'current_user_can' ) ) {
		if ( ! current_user_can( 'edit_posts' ) ) {
			add_filter( 'rest_endpoints', 'mrk_add_permission_rest_users' );
		}
	}
}
add_action( 'init', 'mrk_auth_rest_endpoints' );
