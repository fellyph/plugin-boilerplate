<?php
/**
 * Handle frontend scripts
 *
 * @class       FellyphTest_Frontend_Scripts
 * @version     1.0.0
 * @package     Fellyph_Test/Classes/
 * @category    Class
 * @author      fellyph
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once FellyphTestFn()->plugin_path() . '/includes/class-fellyphtest-assets.php';

/**
 * FellyphTest_Frontend_Scripts Class.
 */
class FellyphTest_Frontend_Assets extends FellyphTest_Assets {

	/**
	 * Hook in methods.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'wp_print_scripts', array( $this, 'localize_printed_scripts' ), 5 );
		add_action( 'wp_print_footer_scripts', array( $this, 'localize_printed_scripts' ), 5 );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_styles() {
		return apply_filters(
			'fellyph_test_enqueue_styles',
			array(
				'fellyph-test-general' => array(
					'src' => $this->localize_asset( 'css/frontend/fellyph-test.css' ),
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
			'fellyph_test_enqueue_scripts',
			array(
				'fellyph-test-general' => array(
					'src'  => $this->localize_asset( 'js/frontend/fellyph-test.js' ),
					'data' => array(
						'ajax_url' => FellyphTestFn()->ajax_url(),
					),
				),
			)
		);
	}

}

new FellyphTest_Frontend_Assets();
