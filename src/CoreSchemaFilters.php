<?php
/**
 * Adds filters that modify core schema.
 *
 * @package WPGraphQL\SiteEditor
 */

namespace WPGraphQL\SiteEditor;

use AxeWP\GraphQL\Interfaces\Registrable;
use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartAreaLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplateLoader;
use WPGraphQL\SiteEditor\Model\Template;
use WPGraphQL\SiteEditor\Model\TemplatePart;

/**
 * Class - CoreSchemaFilters
 */
class CoreSchemaFilters implements Registrable {
	/**
	 * {@inheritDoc}
	 */
	public static function init() : void {
		add_filter( 'graphql_fse_type_prefix', [ __CLASS__, 'get_type_prefix' ] );
		add_filter( 'graphql_data_loaders', [ __CLASS__, 'register_loaders' ], 10, 2 );
		add_filter( 'wpgraphql_content_blocks_resolver_content', [ __CLASS__, 'get_content_from_model' ], 10, 2 );
	}

	/**
	 * Prefixes all plugin GraphQL types.
	 *
	 * @param string $type_name the non-prefixed type name.
	 */
	public static function get_type_prefix( string $type_name = null ) : string {
		return '';
	}

	/**
	 * Registers loaders to AppContext.
	 *
	 * @param array      $loaders Data loaders.
	 * @param AppContext $context App context.
	 */
	public static function register_loaders( array $loaders, AppContext $context ) : array {
		$loaders[ TemplatePartAreaLoader::LOADER_NAME ] = new TemplatePartAreaLoader( $context );
		$loaders[ TemplatePartLoader::LOADER_NAME ]     = new TemplatePartLoader( $context );
		$loaders[ TemplateLoader::LOADER_NAME ]         = new TemplateLoader( $context );

		return $loaders;
	}

	/**
	 * Gets the content from the model for parsing by WPGraphQL ContentBlocks.
	 *
	 * @param string                 $content The content to parse.
	 * @param \WPGraphQL\Model\Model $model   The model to get content from.
	 */
	public static function get_content_from_model( $content, $model ) : string {
		if ( $model instanceof Template || $model instanceof TemplatePart ) {
			$content = $model->content ?: '';
		}

		return $content;
	}
}
