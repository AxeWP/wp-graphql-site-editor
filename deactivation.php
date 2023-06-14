<?php
/**
 * Deactivation Hook
 *
 * @package WPGraphql\SiteEditor
 */

if ( ! function_exists( 'graphql_fse_deactivation_callback' ) ) {
	/**
	 * Runs when WPGraphQL is de-activated.
	 *
	 * This cleans up data that WPGraphQL stores.
	 */
	function graphql_fse_deactivation_callback(): callable {
		return static function (): void {

			// Fire an action when WPGraphQL is de-activating.
			do_action( 'graphql_fse_deactivate' );

			// Delete data during activation.
			graphql_fse_delete_data();
		};
	}
}

if ( ! function_exists( 'graphql_fse_delete_data' ) ) {
	/**
	 * Delete data on deactivation.
	 */
	function graphql_fse_delete_data(): void {
		// Delete plugin version.
		delete_option( 'wp_graphql_fse_version' );

		do_action( 'graphql_fse_delete_data' );
	}
}
