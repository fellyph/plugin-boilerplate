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

		// adding menu.
		add_action( 'admin_menu', array( $this, 'my_admin_menu' ) );

		// register settings.
		add_action( 'admin_init', array( $this, 'register_fellyph_test_settings' ) );
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

	/**
	 * Adding admin menu
	 */
	public function my_admin_menu() {
		add_menu_page(
			__( 'Buyer keywords settings', 'fellyph-test' ),
			__( 'Buyer keywords', 'fellyph-test' ),
			'manage_options',
			'fellyph-test/settings.php',
			array( $this, 'fellyphtest_admin_page' ),
			'dashicons-palmtree',
			250
		);
	}

	/**
	 * Calling admin view
	 */
	public function fellyphtest_admin_page() {
		require_once 'views/admin-display.php';
	}

	/**
	 * Check value before save - I got stucked at that part some comments at the feedback md file
	 *
	 * @access private
	 * @param  string $input
	 * @return string
	 */
	private function save_keywords( $input ) {
		$keys_list = ( is_array( get_option( 'user_keyword_list' ) ) ?
			get_option( 'user_keyword_list' ) : array() );
		array_push( $keys_list, esc_html( $input ) );
		update_option( 'user_keyword_list', $keys_list );
		return $input;
	}

	/**
	 * Register all settings value at admin page
	 */
	public function register_fellyph_test_settings() {
		$args_list  = array( 'type' => 'array' );
		$args_input = array(
			'type'              => 'string',
			'sanitize_callback' => array( $this, 'save_keywords' ),
		);
		register_setting( 'fellyph-test-keywords', 'user_keyword', $args_input );
		register_setting( 'fellyph-test-keywords', 'user_keyword_list', $args_list );
	}
}

return new FellyphTest_Admin();
