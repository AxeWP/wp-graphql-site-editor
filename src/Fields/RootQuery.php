<?php
/**
 * Registers fields to RootQuery
 *
 * @package WPGraphQL\Fields
 */

namespace WPGraphQL\SiteEditor\Fields;

use AxeWP\GraphQL\Abstracts\FieldsType;
use GraphQL\Error\UserError;
use GraphQLRelay\Relay;
use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Data\Loader\TemplateLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartAreaLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartLoader;
use WPGraphQL\SiteEditor\Type\Enum\TemplatePartAreaEnum;
use WPGraphQL\SiteEditor\Type\Enum\TemplatePartIdTypeEnum;
use WPGraphQL\SiteEditor\Type\WPObject\Template;
use WPGraphQL\SiteEditor\Type\WPObject\TemplatePart;
use WPGraphQL\SiteEditor\Type\WPObject\TemplatePartArea;

/**
 * Class - RootQuery
 */
class RootQuery extends FieldsType {

	/**
	 * {@inheritDoc}
	 */
	protected static function type_name() : string {
		return 'RootQuery';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	public static function get_type_name() : string {
		return static::type_name();
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_fields() : array {
		return [
			'globalStylesheet' => [
				'type'        => 'String',
				'description' => __( 'The global stylesheet', 'wp-graphql-site-editor' ),
				'resolve'     => fn() => wp_get_global_stylesheet(),
			],
			'templatePartArea' => [
				'type'        => TemplatePartArea::get_type_name(),
				'description' => __( 'The template part area', 'wp-graphql-site-editor' ),
				'args'        => [
					'area' => [
						'type'        => [ 'non_null' => TemplatePartAreaEnum::get_type_name() ],
						'description' => __( 'The template part area', 'wp-graphql-site-editor' ),
					],
				],
				'resolve'     => function( $source, array $args, AppContext $context ) {
					return $context->get_loader( TemplatePartAreaLoader::LOADER_NAME )->load_deferred( $args['area'] );
				},
			],
			'templatePart'     => [
				'type'        => TemplatePart::get_type_name(),
				'description' => __( 'The template part', 'wp-graphql-site-editor' ),
				'args'        => [
					'id'     => [
						'type'        => [ 'non_null' => 'ID' ],
						'description' => __( 'The template part ID', 'wp-graphql-site-editor' ),
					],
					'idType' => [
						'type'        => TemplatePartIdTypeEnum::get_type_name(),
						'description' => __( 'The template part ID type', 'wp-graphql-site-editor' ),
					],
				],
				'resolve'     => function( $source, array $args, AppContext $context ) {
					if ( empty( $args['idType'] ) ) {
						throw new UserError( __( 'The template part ID type is required', 'wp-graphql-site-editor' ) );
					}

					switch ( $args['idType'] ) {
						case 'id':
							$parts = Relay::fromGlobalId( $args['id'] );

							if ( empty( $parts['id'] ) ) {
								throw new UserError( __( 'The global ID is invalid', 'wp-graphql-site-editor' ) );
							}

							$slug = $parts['id'];
							break;
						case 'databaseId':
							$slug = get_post_field( 'post_name', $args['id'], 'raw' );

							if ( empty( $slug ) ) {
								throw new UserError( __( 'Invalid database ID', 'wp-graphql-site-editor' ) );
							}

							break;
						case 'slug':
							$slug = $args['id'];
							break;
					}

					if ( empty( $slug ) ) {
						return null;
					}

					return $context->get_loader( TemplatePartLoader::LOADER_NAME )->load_deferred( $slug );
				},
			],
			'template'         => [
				'type'        => Template::get_type_name(),
				'description' => __( 'The template', 'wp-graphql-site-editor' ),
				'args'        => [
					'id'     => [
						'type'        => [ 'non_null' => 'ID' ],
						'description' => __( 'The template ID', 'wp-graphql-site-editor' ),
					],
					'idType' => [
						'type'        => TemplatePartIdTypeEnum::get_type_name(),
						'description' => __( 'The template ID type', 'wp-graphql-site-editor' ),
					],
				],
				'resolve'     => function( $source, array $args, AppContext $context ) {
					if ( empty( $args['idType'] ) ) {
						throw new UserError( __( 'The template part ID type is required', 'wp-graphql-site-editor' ) );
					}

					switch ( $args['idType'] ) {
						case 'id':
							$parts = Relay::fromGlobalId( $args['id'] );

							if ( empty( $parts['id'] ) ) {
								throw new UserError( __( 'The global ID is invalid', 'wp-graphql-site-editor' ) );
							}

							$slug = $parts['id'];
							break;
						case 'databaseId':
							$slug = get_post_field( 'post_name', $args['id'], 'raw' );

							if ( empty( $slug ) ) {
								throw new UserError( __( 'Invalid database ID', 'wp-graphql-site-editor' ) );
							}

							break;
						case 'slug':
							$slug = $args['id'];
							break;
					}

					if ( empty( $slug ) ) {
						return null;
					}

					return $context->get_loader( TemplateLoader::LOADER_NAME )->load_deferred( $slug );
				},
			],

		];
	}
}
