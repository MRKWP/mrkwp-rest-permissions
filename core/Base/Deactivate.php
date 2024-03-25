<?php
/**
 * Deactivate Class.
 *
 * @package MRK_Rest_Permissions
 */

namespace MRK_Rest_Permissions\Base;

/**
 * Deactivate Class
 */
class Deactivate {
	/**
	 * Static function for Deactivate.
	 *
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
