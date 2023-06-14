<?php
/**
 * Activation Hook
 *
 * @package WPGraphql\SiteEditor
 */

if ( ! function_exists( 'graphql_fse_activation_callback' ) ) {
	/**
	 * Runs when the plugin is activated.
	 */
	function graphql_fse_activation_callback(): callable {
		return static function (): void {
			do_action( 'graphql_fse_activate' );

			// store the current version of the plugin.
			update_option( 'wp_graphql_fse_version', WPGRAPHQL_FSE_VERSION );
		};
	}
}
