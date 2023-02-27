<?php
/**
 * The TemplatePartIdType Enum
 *
 * @package WPGraphQL\SiteEditor\Type\Enum
 */

namespace WPGraphQL\SiteEditor\Type\Enum;

use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Abstracts\EnumType;

/**
 * Class - TemplatePartIdTypeEnum
 */
class TemplatePartIdTypeEnum extends EnumType {
	/**
	 * {@inheritDoc}
	 */
	protected static function type_name() : string {
		return 'TemplatePartIdTypeEnum';
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_description(): string {
		return __( 'The Template Part ID type', 'wp-graphql-site-editor' );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_values(): array {
		return [
			'ID'          => [
				'description' => __( 'The global ID.', 'wp-graphql-site-editor' ),
				'value'       => 'id',
			],
			'SLUG'        => [
				'description' => __( 'The template part slug.', 'wp-graphql-site-editor' ),
				'value'       => 'slug',
			],
			'DATABASE_ID' => [
				'description' => __( 'Post ID of customized template part.', 'wp-graphql-site-editor' ),
				'value'       => 'databaseId',
			],
		];
	}
}
