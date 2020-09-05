<?php
/**
 * Installation related functions and actions.
 *
 * @author   fellyph
 * @category Admin
 * @package  Fellyph_Test/Classes
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FellyphTest_Install Class.
 */
class FellyphTest_Install {

	/**
	 * Install FellyphTest.
	 */
	public static function install() {
		// PERFORM INSTALL ACTIONS HERE

		// Trigger action
		do_action( 'fellyph_test_installed' );
	}
}

register_activation_hook( FELLYPHTEST_PLUGIN_FILE, array( 'FellyphTest_Install', 'install' ) );
