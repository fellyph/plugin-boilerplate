<?php
/**
 * WordPress Plugin Boilerplate Template Functions
 *
 * Functions related to templates.
 *
 * @author   fellyph
 * @category Core
 * @package  Fellyph_Test/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get template part.
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 */
function fellyph_test_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/fellyph-test/slug-name.php
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", FellyphTestFn()->template_path() . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( FellyphTestFn()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
		$template = FellyphTestFn()->plugin_path() . "/templates/{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/fellyph-test/slug.php
	if ( ! $template ) {
		$template = locate_template( array( "{$slug}.php", FellyphTestFn()->template_path() . "{$slug}.php" ) );
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'fellyph_test_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Get other templates passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function fellyph_test_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		// phpcs:ignore WordPress.PHP.DontExtract
		extract( $args );
	}

	$located = fellyph_test_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0.0' ); // WPCS: XSS ok.
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'fellyph_test_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'fellyph_test_before_template_part', $template_name, $template_path, $located, $args );

	include $located;

	do_action( 'fellyph_test_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Like fellyph_test_get_template, but returns the HTML instead of outputting.
 * @see fellyph_test_get_template
 * @since 2.5.0
 * @param string $template_name
 */
function fellyph_test_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	ob_start();
	fellyph_test_get_template( $template_name, $args, $template_path, $default_path );
	return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function fellyph_test_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = FellyphTestFn()->template_path();
	}

	if ( ! $default_path ) {
		$default_path = FellyphTestFn()->plugin_path() . '/templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'fellyph_test_locate_template', $template, $template_name, $template_path );
}
