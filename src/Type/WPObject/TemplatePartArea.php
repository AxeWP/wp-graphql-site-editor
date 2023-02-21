<?php
/**
 * The Template Part Area GraphQL Object.
 *
 * @package WPGraphQL\SiteEditor\Type\WPObject
 */

namespace WPGraphQL\SiteEditor\Type\WPObject;

use AxeWP\GraphQL\Abstracts\ObjectType;
use AxeWP\GraphQL\Interfaces\TypeWithInterfaces;
use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Model\TemplatePart as TemplatePartModel;
use WPGraphQL\SiteEditor\Type\WPObject\TemplatePart;
use WPGraphQL\SiteEditor\Type\Enum\TemplatePartAreaEnum;

/**
 * Class - TemplatePartArea
 */
class TemplatePartArea extends ObjectType implements TypeWithInterfaces {

	/**
	 * {@inheritDoc}
	 */
	protected static function type_name() : string {
		return 'TemplatePartArea';
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_description() : string {
		return __( 'The block template part area.', 'wp-graphql-site-editor' );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_fields() : array {
		return [
			'area'               => [
				'type'        => TemplatePartAreaEnum::get_type_name(),
				'description' => __( 'The template part area.', 'wp-graphql-site-editor' ),
			],
			'areaTag'            => [
				'type'        => 'String',
				'description' => __( 'The HTML tag used to wrap the template part area.', 'wp-graphql-site-editor' ),
			],
			'description'        => [
				'type'        => 'String',
				'description' => __( 'The template area description.', 'wp-graphql-site-editor' ),
			],
			'icon'               => [
				'type'        => 'String',
				'description' => __( 'The template area icon.', 'wp-graphql-site-editor' ),
			],
			'id'                 => [
				'type'        => [ 'non_null' => 'ID' ],
				'description' => __( 'The template part area global ID.', 'wp-graphql-site-editor' ),
			],
			'label'              => [
				'type'        => 'String',
				'description' => __( 'The template area label.', 'wp-graphql-site-editor' ),
			],
			'activeTemplatePart' => [
				'type'        => TemplatePart::get_type_name(),
				'description' => __( 'The active template part assigned to the area', 'wp-graphql-site-editor' ),
				'resolve'     => fn( $source, array $args, AppContext $context ) => ! empty( $source->activeTemplatePart ) ? new TemplatePartModel( $source->activeTemplatePart ) : null,
			],
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_interfaces() : array {
		return [ 'Node' ];
	}
}
