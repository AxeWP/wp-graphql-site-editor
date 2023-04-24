<?php
/**
 * Initializes a singleton instance of the plugin.
 *
 * @package WPGraphQL\SiteEditor
 */

namespace WPGraphQL\SiteEditor;

use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Helper\Helper;

if ( ! class_exists( 'WPGraphQL\SiteEditor\Main' ) ) :

	/**
	 * Class - Main
	 */
	final class Main {
		/**
		 * Class instances.
		 *
		 * @var ?self $instance
		 */
		private static $instance;

		/**
		 * Constructor
		 */
		public static function instance() : self {
			if ( ! isset( self::$instance ) || ! ( is_a( self::$instance, __CLASS__ ) ) ) {
				// You cant test a singleton.
				// @codeCoverageIgnoreStart
				if ( ! function_exists( 'is_plugin_active' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}
				self::$instance = new self();
				self::$instance->includes();
				self::$instance->setup();
				// @codeCoverageIgnoreEnd
			}

			/**
			 * Fire off init action.
			 *
			 * @param self $instance the instance of the plugin class.
			 */
			do_action( 'graphql_fse_init', self::$instance );

			return self::$instance;
		}

		/**
		 * Includes the required files with Composer's autoload.
		 *
		 * @codeCoverageIgnore
		 */
		private function includes() : void {
			if ( defined( 'WPGRAPHQL_FSE_AUTOLOAD' ) && false !== WPGRAPHQL_FSE_AUTOLOAD && defined( 'WPGRAPHQL_FSE_PLUGIN_DIR' ) ) {
				require_once WPGRAPHQL_FSE_PLUGIN_DIR . 'vendor/autoload.php';
			}
		}

		/**
		 * Sets up the schema.
		 *
		 * @codeCoverageIgnore
		 */
		private function setup() : void {
			// // Setup boilerplate hook prefix.
			Helper::set_hook_prefix( 'graphql_fse' );

			// Setup plugin.
			CoreSchemaFilters::init();
			TypeRegistry::init();
		}

		/**
		 * Throw error on object clone.
		 * The whole idea of the singleton design pattern is that there is a single object
		 * therefore, we don't want the object to be cloned.
		 *
		 * @codeCoverageIgnore
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'The plugin Main class should not be cloned.', 'wp-graphql-site-editor' ), '0.0.1' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @codeCoverageIgnore
		 */
		public function __wakeup() : void {
			// De-serializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'De-serializing instances of the plugin Main class is not allowed.', 'wp-graphql-site-editor' ), '0.0.1' );
		}
	}
endif;
