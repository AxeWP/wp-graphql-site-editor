<?php
/**
 * Plugin Name: WPGraphQL for FSE
 * Plugin URI: https://github.com/AxeWP/wp-graphql-site-editor
 * GitHub Plugin URI: https://github.com/AxeWP/wp-graphql-site-editor
 * Description: Adds support for Full Site Editing to WPGraphQL.
 * Author: AxePress
 * Author URI: https://github.com/AxeWP
 * Update URI: https://github.com/AxeWP/wp-graphql-site-editor
 * Version: 0.0.1
 * Text Domain: wp-graphql-site-editor
 * Domain Path: /languages
 * Requires at least: 5.4.1
 * Tested up to: 6.1
 * Requires PHP: 7.4
 * WPGraphQL requires at least: 1.8.1
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package WPGraphQL\SiteEditor
 * @author axepress
 * @license GPL-3
 * @version 0.0.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If the codeception remote coverage file exists, require it.
// This file should only exist locally or when CI bootstraps the environment for testing.
if ( file_exists( __DIR__ . '/c3.php' ) ) {
	require_once __DIR__ . '/c3.php';
}

// Run this function when the plugin is activated.
if ( file_exists( __DIR__ . '/activation.php' ) ) {
	require_once __DIR__ . '/activation.php';
	register_activation_hook( __FILE__, 'graphql_fse_activation_callback' );
}

// Run this function when the plugin is deactivated.
if ( file_exists( __DIR__ . '/deactivation.php' ) ) {
	require_once __DIR__ . '/deactivation.php';
	register_activation_hook( __FILE__, 'graphql_fse_deactivation_callback' );
}


/**
 * Define plugin constants.
 */
function graphql_fse_constants() : void {
	// Plugin version.
	if ( ! defined( 'WPGRAPHQL_FSE_VERSION' ) ) {
		define( 'WPGRAPHQL_FSE_VERSION', '0.0.8' );
	}

	// Plugin Folder Path.
	if ( ! defined( 'WPGRAPHQL_FSE_PLUGIN_DIR' ) ) {
		define( 'WPGRAPHQL_FSE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}

	// Plugin Folder URL.
	if ( ! defined( 'WPGRAPHQL_FSE_PLUGIN_URL' ) ) {
		define( 'WPGRAPHQL_FSE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

	// Plugin Root File.
	if ( ! defined( 'WPGRAPHQL_FSE_PLUGIN_FILE' ) ) {
		define( 'WPGRAPHQL_FSE_PLUGIN_FILE', __FILE__ );
	}

	// Whether to autoload the files or not.
	if ( ! defined( 'WPGRAPHQL_FSE_AUTOLOAD' ) ) {
		define( 'WPGRAPHQL_FSE_AUTOLOAD', true );
	}

	// The Plugin Boilerplate hook prefix.
	if ( ! defined( 'AXEWP_PB_HOOK_PREFIX' ) ) {
		define( 'AXEWP_PB_HOOK_PREFIX', 'graphql_fse' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
	}
}

/**
 * Checks if all the the required plugins are installed and activated.
 */
function graphql_fse_dependencies_not_ready() : array {
	$deps = [];

	if ( ! class_exists( '\WPGraphQL' ) ) {
		$deps[] = 'WPGraphQL';
	}
	if ( ! class_exists( '\WPGraphQLContentBlocks' ) ) {
		$deps[] = 'WPGraphQL Content Blocks';
	}

	return $deps;
}

/**
 * Initializes plugin.
 */
function graphql_fse_init() : void {
	graphql_fse_constants();

	$not_ready = graphql_fse_dependencies_not_ready();

	if ( empty( $not_ready ) && defined( 'WPGRAPHQL_FSE_PLUGIN_DIR' ) ) {
		require_once WPGRAPHQL_FSE_PLUGIN_DIR . 'src/Main.php';
		\WPGraphQL\SiteEditor\Main::instance();
		return;
	}

	foreach ( $not_ready as $dep ) {
		add_action(
			'admin_notices',
			function() use ( $dep ) {
				?>
				<div class="error notice">
					<p>
						<?php
							printf(
								/* translators: dependency not ready error message */
								esc_html__( '%1$s must be active for WPGraphQL for Full Site Editor to work.', 'wp-graphql-site-editor' ),
								esc_html( $dep )
							);
						?>
					</p>
				</div>
				<?php
			}
		);
	}
}

add_action( 'graphql_init', 'graphql_fse_init' );
