<?php
/**
 * Registers the connections to Template
 *
 * @package WPGraphQL\SiteEditor\Connection
 */

namespace WPGraphQL\SiteEditor\Connection;

use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Data\Connection\TemplateConnectionResolver;
use WPGraphQL\SiteEditor\Type\WPObject\Template;
use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Abstracts\ConnectionType;

/**
 * Class - TemplateConnection
 */
class TemplateConnection extends ConnectionType {

	/**
	 * {@inheritDoc}
	 */
	protected static function type_name() : string {
		return Template::get_type_name();
	}

	/**
	 * {@inheritDoc}
	 */
	public static function register() : void {
		/** @var array $config */
		$config = self::get_connection_config(
			[
				'fromType'       => 'RootQuery',
				'fromFieldName'  => 'templates',
				'connectionArgs' => self::get_connection_args(),
				'description'    => __( 'Block Templates', 'wp-graphql-site-editor' ),
				'resolve'        => static function ( $source, array $args, AppContext $context, ResolveInfo $info ) {
					$resolver = new TemplateConnectionResolver( $source, $args, $context, $info );

					return $resolver->get_connection();
				},
			]
		);

		register_graphql_connection( $config );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function connection_args() : array {
		return [
			'slugIn'      => [
				'type'        => [ 'list_of' => 'String' ],
				'description' => __( 'A list of template part slugs to include', 'wp-graphql-site-editor' ),
			],
			'contentType' => [ // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'type'        => [ 'list_of' => 'PostTypeEnum' ],
				'description' => __( 'A list of post types associated with the template part', 'wp-graphql-site-editor' ),
			],
		];
	}

}
