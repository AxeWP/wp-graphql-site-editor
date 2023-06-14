<?php
/**
 * Registers the connections to TemplatePartArea
 *
 * @package WPGraphQL\SiteEditor\Connection
 */

namespace WPGraphQL\SiteEditor\Connection;

use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Data\Connection\TemplatePartAreaConnectionResolver;
use WPGraphQL\SiteEditor\Type\Enum\TemplatePartAreaEnum;
use WPGraphQL\SiteEditor\Type\WPObject\TemplatePartArea;
use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Abstracts\ConnectionType;

/**
 * Class - TemplatePartAreaConnection
 */
class TemplatePartAreaConnection extends ConnectionType {
	/**
	 * {@inheritDoc}
	 */
	protected static function type_name(): string {
		return TemplatePartArea::get_type_name();
	}

	/**
	 * {@inheritDoc}
	 */
	public static function register(): void {
		/** @var array $config */
		$config = self::get_connection_config(
			[
				'fromType'       => 'RootQuery',
				'fromFieldName'  => 'templatePartAreas',
				'connectionArgs' => self::get_connection_args(),
				'description'    => __( 'Template part areas', 'wp-graphql-site-editor' ),
				'resolve'        => static function ( $source, array $args, AppContext $context, ResolveInfo $info ) {
					$resolver = new TemplatePartAreaConnectionResolver( $source, $args, $context, $info );

					return $resolver->get_connection();
				},
			]
		);

		register_graphql_connection( $config );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function connection_args(): array {
		return [
			'include' => [
				'type'        => [ 'list_of' => TemplatePartAreaEnum::get_type_name() ],
				'description' => __( 'The template part areas to include.', 'wp-graphql-site-editor' ),
			],
			'exclude' => [ // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'type'        => [ 'list_of' => TemplatePartAreaEnum::get_type_name() ],
				'description' => __( 'The template part areas to exclude.', 'wp-graphql-site-editor' ),
			],
		];
	}
}
