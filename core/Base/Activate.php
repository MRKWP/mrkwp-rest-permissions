<?php
/**
 * Simple Activation Class.
 *
 * @package MRK_Rest_Permissions
 */

namespace MRK_Rest_Permissions\Base;

/**
 * Activate Class.
 */
class Activate {
	/**
	 * Hooked for Activate inside Plugin.
	 *
	 * @return void
	 */
	public static function activate() {
		flush_rewrite_rules();
	}
}
