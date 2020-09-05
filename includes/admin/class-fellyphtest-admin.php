<?php
/**
 * WordPress Plugin Boilerplate Admin
 *
 * @class    FellyphTest_Admin
 * @author   fellyph
 * @category Admin
 * @package  Fellyph_Test/Admin
 * @version  2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * FellyphTest_Admin class.
 */
class FellyphTest_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->includes();
		add_action( 'current_screen', array( $this, 'conditional_includes' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once 'fellyph-test-admin-functions.php';
		include_once 'class-fellyphtest-admin-assets.php';
	}

	/**
	 * Include admin files conditionally.
	 */
	public function conditional_includes() {
		$screen = get_current_screen();
		if ( ! $screen ) {
			return;
		}

		switch ( $screen->id ) {
			case 'dashboard':
			case 'options-permalink':
			case 'users':
			case 'user':
			case 'profile':
			case 'user-edit':
		}
	}
}

return new FellyphTest_Admin();
