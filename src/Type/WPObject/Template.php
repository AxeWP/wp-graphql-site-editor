<?php
/**
 * The Template Part Area GraphQL Object.
 *
 * @package WPGraphQL\SiteEditor\Type\WPObject
 */

namespace WPGraphQL\SiteEditor\Type\WPObject;

use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Abstracts\ObjectType;
use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Interfaces\TypeWithInterfaces;

/**
 * Class - Template
 */
class Template extends ObjectType implements TypeWithInterfaces {
	/**
	 * {@inheritDoc}
	 */
	protected static function type_name(): string {
		return 'Template';
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_description(): string {
		return __( 'The block template.', 'wp-graphql-site-editor' );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_fields(): array {
		return [
			'authorId'         => [
				'type'        => 'ID',
				'description' => __( 'The globally unique identifier of the author of the node', 'wp-graphql-site-editor' ),
			],
			'authorDatabaseId' => [
				'type'        => 'Int',
				'description' => __( 'The database identifier of the author of the node', 'wp-graphql-site-editor' ),
			],
			'description'      => [
				'type'        => 'String',
				'description' => __( 'The template part description.', 'wp-graphql-site-editor' ),
			],
			'hasThemeFile'     => [
				'type'        => 'Boolean',
				'description' => __( 'Whether the template part has a theme file.', 'wp-graphql-site-editor' ),
			],
			'isCustom'         => [
				'type'        => 'Boolean',
				'description' => __( 'Whether the template part is custom.', 'wp-graphql-site-editor' ),
			],
			'id'               => [
				'type'        => [ 'non_null' => 'ID' ],
				'description' => __( 'The template part global ID.', 'wp-graphql-site-editor' ),
			],
			'origin'           => [
				'type'        => 'String',
				'description' => __( 'The template part origin.', 'wp-graphql-site-editor' ),
			],
			'contentTypes'     => [
				'type'        => [ 'list_of' => 'ContentTypeEnum' ],
				'description' => __( 'The post type or types associated with this Template Part', 'wp-graphql-site-editor' ),
			],
			'slug'             => [
				'type'        => 'String',
				'description' => __( 'The template part slug.', 'wp-graphql-site-editor' ),
			],
			'source'           => [
				'type'        => 'String',
				'description' => __( 'The template part source.', 'wp-graphql-site-editor' ),
			],
			'status'           => [
				'type'        => 'PostStatusEnum',
				'description' => __( 'The status of the object.', 'wp-graphql-site-editor' ),
			],
			'theme'            => [
				'type'        => 'String',
				'description' => __( 'The theme the template part belongs to.', 'wp-graphql-site-editor' ),
			],
			'title'            => [
				'type'        => 'String',
				'description' => __( 'The template part title.', 'wp-graphql-site-editor' ),
			],
			'type'             => [
				'type'        => 'String',
				'description' => __( 'The template part area.', 'wp-graphql-site-editor' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_interfaces(): array {
		return [
			'Node',
			'NodeWithContentEditor',
			'NodeWithEditorBlocks',
		];
	}
}
