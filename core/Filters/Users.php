<?php
/**
 * Register Users REST API Permissions Filter
 */

namespace MRK_Rest_Permissions\Filters;

/**
 * Used to remove users from the REST API.
 */
class Users {

	/**
	 * Register filter
	 *
	 * @return void
	 */
	public function register() {

		// Add filter to remove users end point.
		add_filter( 'rest_endpoints', array( $this, 'mrk_remove_rest_users' ) );
	}
		/**
		 * Remove users from REST API
		 *
		 * @param array $endpoints A string containing the users endpoint.
		 *
		 * @return array
		 */
	public function mrk_remove_rest_users( $endpoints ) {

		if ( ! is_user_logged_in() ) {

			if ( isset( $endpoints['/wp/v2/users'] ) ) {
				unset( $endpoints['/wp/v2/users'] );
			}
			if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
				unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
			}
		}

			return $endpoints;
	}

}
