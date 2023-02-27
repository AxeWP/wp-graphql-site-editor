<?php
/**
 * The Template Part Area enum.
 *
 * @package WPGraphQL\SiteEditor\Type\Enum
 */

namespace WPGraphQL\SiteEditor\Type\Enum;

use WPGraphQL\Type\WPEnumType;
use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Abstracts\EnumType;

/**
 * Class - TemplatePartAreaEnum
 */
class TemplatePartAreaEnum extends EnumType {
	/**
	 * {@inheritDoc}
	 */
	protected static function type_name() : string {
		return 'TemplatePartAreaEnum';
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_description(): string {
		return __( 'The allowed template part areas.', 'wp-graphql-site-editor' );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_values(): array {
		$areas = get_allowed_block_template_part_areas();

		$values = [];

		foreach ( $areas as $area ) {
			$values[ WPEnumType::get_safe_name( $area['area'] ) ] = [
				// translators: %s is the locale.
				'description' => sprintf( __( '%s template part area.', 'wp-graphql-site-editor' ), $area['label'] ),
				'value'       => $area['area'],
			];
		}

		return $values;
	}
}
