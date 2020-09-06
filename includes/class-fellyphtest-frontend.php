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
	exit; // Exit if accessed directly.
}

/**
 * FellyphTest_Frontend class.
 */
class FellyphTest_Frontend {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_shortcode( 'users_keywords', $this->get_keywords );
	}

	/**
	 * Adding initial function
	 */
	public function get_keywords() {
		// get general settings options.
		$admin_key_word = esc_html( get_option( 'users_keywords' ) );
		echo ( esc_html( $admin_key_word ) );
	}
}

return new FellyphTest_Frontend();
