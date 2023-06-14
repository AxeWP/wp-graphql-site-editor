<?php
/**
 * Helper methods.
 *
 * @package WPGraphQL\SiteEditor\Utils\Utils;
 */

namespace WPGraphQL\SiteEditor\Utils;

use WP_Block_Template;

/**
 * Class - Utils
 */
class Utils {
	/**
	 * Gets a template-part.
	 *
	 * @see wp-includes\block-template-utils.php::block_template_part()
	 *
	 * @param string $part The template-part to print. Use "header" or "footer".
	 */
	public static function get_block_template_part( string $part ): ?WP_Block_Template {
		return get_block_template( get_stylesheet() . '//' . $part, 'wp_template_part' );
	}

	/**
	 * Gets a template.
	 *
	 * @see wp-includes\block-template-utils.php::block_template_part()
	 *
	 * @param string $slug The template to print. Use "index" or "single".
	 */
	public static function get_block_template( string $slug ): ?WP_Block_template {
		return get_block_template( get_stylesheet() . '//' . $slug, 'wp_template' );
	}
}
