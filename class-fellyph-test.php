<?php
/**
 * Installation related functions and actions.
 *
 * @author   fellyph
 * @category Core
 * @package  Fellyph_Test
 * @version  1.0.0
 */

if ( ! class_exists( 'Fellyph_Test' ) ) :

	final class Fellyph_Test {

		/**
		 * Fellyph_Test version.
		 *
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * The single instance of the class.
		 *
		 * @var Fellyph_Test
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		protected static $_initialized = false;

		/**
		 * Main Fellyph_Test Instance.
		 *
		 * Ensures only one instance of Fellyph_Test is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see FellyphTestFn()
		 * @return Fellyph_Test - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->initalize_plugin();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 * @since 1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'fellyph-test' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 * @since 1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'fellyph-test' ), '1.0.0' );
		}

		/**
		 * Fellyph_Test Initializer.
		 */
		public function initalize_plugin() {
			if ( self::$_initialized ) {
				_doing_it_wrong( __FUNCTION__, esc_html__( 'Only a single instance of this class is allowed. Use singleton.', 'fellyph-test' ), '1.0.0' );
				return;
			}

			self::$_initialized = true;

			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			do_action( 'fellyph_test_loaded' );
		}

		/**
		 * Define FellyphTest Constants.
		 */
		private function define_constants() {
			$upload_dir = wp_upload_dir();

			$this->define( 'FELLYPHTEST_PLUGIN_BASENAME', plugin_basename( FELLYPHTEST_PLUGIN_FILE ) );
			$this->define( 'FELLYPHTEST_VERSION', $this->version );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 *
		 * @param  string $type admin, ajax, cron or frontend.
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin':
					return is_admin();
				case 'ajax':
					return defined( 'DOING_AJAX' );
				case 'cron':
					return defined( 'DOING_CRON' );
				case 'frontend':
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		private function includes() {
			include_once 'includes/class-fellyphtest-autoloader.php';
			include_once 'includes/fellyph-test-core-functions.php';
			include_once 'includes/class-fellyphtest-install.php';

			if ( $this->is_request( 'admin' ) ) {
				include_once 'includes/admin/class-fellyphtest-admin.php';
			}

			if ( $this->is_request( 'frontend' ) ) {
				include_once 'includes/class-fellyphtest-frontend-assets.php'; // Frontend Scripts
			}

			$this->customizations_includes();
		}

		/**
		 * Include required customizations files.
		 */
		private function customizations_includes() {
			$customizations = array(
				'acf',
			);

			foreach ( $customizations as $customization ) {
				include_once 'includes/customizations/class-fellyphtest-' . $customization . '-hooks.php';
			}
		}

		/**
		 * Hook into actions and filters.
		 * @since  1.0.0
		 */
		private function init_hooks() {
			add_action( 'init', array( $this, 'init' ), 0 );
		}

		/**
		 * Init Fellyph_Test when WordPress Initialises.
		 */
		public function init() {
			// Before init action.
			do_action( 'before_fellyph_test_init' );

			// Set up localisation.
			$this->load_plugin_textdomain();

			// Init action.
			do_action( 'fellyph_test_init' );
		}

		/**
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 *
		 * Locales found in:
		 *      - WP_LANG_DIR/fellyph-test/fellyph-test-LOCALE.mo
		 *      - WP_LANG_DIR/plugins/fellyph-test-LOCALE.mo
		 */
		private function load_plugin_textdomain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'fellyph-test' );

			load_textdomain( 'fellyph-test', WP_LANG_DIR . '/fellyph-test/fellyph-test-' . $locale . '.mo' );
			load_plugin_textdomain( 'fellyph-test', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Get the template path.
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'fellyph_test_template_path', 'fellyph-test/' );
		}

		/**
		 * Get Ajax URL.
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}
	}

endif;
