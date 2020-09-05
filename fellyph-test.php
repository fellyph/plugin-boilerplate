<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blog.fellyph.com.br
 * @since             1.0.0
 * @package           Fellyph_Test
 *
 * @wordpress-plugin
 * Plugin Name:       Fellyph Test
 * Plugin URI:        https://blog.fellyph.com.br
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            fellyph
 * Author URI:        https://blog.fellyph.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fellyph-test
 * Domain Path:       /i18n/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'FELLYPHTEST_PLUGIN_FILE', __FILE__ );
require_once 'class-fellyph-test.php';

/**
 * Main instance of Fellyph_Test.
 *
 * Returns the main instance of FellyphTest to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Fellyph_Test
 */

// phpcs:ignore WordPress.NamingConventions.ValidFunctionName
function FellyphTestFn() {
	return Fellyph_Test::instance();
}

// Global for backwards compatibility.
$GLOBALS['fellyph_test'] = FellyphTestFn();
