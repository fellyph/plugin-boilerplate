<?php
/**
 * Load assets
 *
 * @author      fellyph
 * @category    Admin
 * @package     FellyphTest/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once FellyphTestFn()->plugin_path() . '/includes/class-fellyphtest-assets.php';

/**
 * FellyphTest_Admin_Assets Class.
 */
class FellyphTest_Admin_Assets extends FellyphTest_Assets {

	/**
	 * Hook in methods.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'admin_print_scripts', array( $this, 'localize_printed_scripts' ), 5 );
		add_action( 'admin_print_footer_scripts', array( $this, 'localize_printed_scripts' ), 5 );

		// adding menu.
		add_action( 'admin_menu', array( $this, 'my_admin_menu' ) );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_styles() {
		return apply_filters(
			'fellyph_test_enqueue_admin_styles',
			array(
				'fellyph-test-admin' => array(
					'src' => $this->localize_asset( 'css/admin/fellyph-test-admin.css' ),
				),
			)
		);
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_scripts() {
		return apply_filters(
			'fellyph_test_enqueue_admin_scripts',
			array(
				'fellyph-test-admin' => array(
					'src'  => $this->localize_asset( 'js/admin/fellyph-test-admin.js' ),
					'data' => array(
						'ajax_url' => FellyphTestFn()->ajax_url(),
					),
				),
			)
		);
	}

}

return new FellyphTest_Admin_Assets();
