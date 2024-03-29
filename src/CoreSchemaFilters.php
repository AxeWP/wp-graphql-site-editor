<?php
/**
 * Adds filters that modify core schema.
 *
 * @package WPGraphQL\SiteEditor
 */

namespace WPGraphQL\SiteEditor;

use WPGraphQL\AppContext;
use WPGraphQL\SiteEditor\Data\Loader\TemplateLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartAreaLoader;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartLoader;
use WPGraphQL\SiteEditor\Model\Template;
use WPGraphQL\SiteEditor\Model\TemplatePart;
use WPGraphQL\SiteEditor\Vendor\AxeWP\GraphQL\Interfaces\Registrable;

/**
 * Class - CoreSchemaFilters
 */
class CoreSchemaFilters implements Registrable {
	/**
	 * {@inheritDoc}
	 */
	public static function init(): void {
		add_filter( 'graphql_fse_type_prefix', [ self::class, 'get_type_prefix' ] );
		add_filter( 'graphql_data_loaders', [ self::class, 'register_loaders' ], 10, 2 );
		add_filter( 'wpgraphql_content_blocks_resolver_content', [ self::class, 'get_content_from_model' ], 10, 2 );
		add_filter( 'render_block', [ self::class, 'render_layout_styles' ], 10, 2 );
	}

	/**
	 * Prefixes all plugin GraphQL types.
	 *
	 * @param string $type_name the non-prefixed type name.
	 */
	public static function get_type_prefix( string $type_name = null ): string {
		return '';
	}

	/**
	 * Registers loaders to AppContext.
	 *
	 * @param array                 $loaders Data loaders.
	 * @param \WPGraphQL\AppContext $context App context.
	 */
	public static function register_loaders( array $loaders, AppContext $context ): array {
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
	public static function get_content_from_model( $content, $model ): string {
		if ( $model instanceof Template || $model instanceof TemplatePart ) {
			$content = $model->content ?: '';
		}

		return $content;
	}

	/**
	 * Filters the content to keep layout styles inline.
	 *
	 * @param string $block_content .
	 * @param array  $block .
	 */
	public static function render_layout_styles( string $block_content, array $block ): string {
		$block_type = \WP_Block_Type_Registry::get_instance()->get_registered( $block['blockName'] );

		// If the block doesn't support layout, bail.
		if ( null === $block_type ) {
			return $block_content;
		}

		$support_layout = block_has_support( $block_type, [ '__experimentalLayout' ], false );
		if ( ! $support_layout ) {
			return $block_content;
		}

		$block_gap              = wp_get_global_settings( [ 'spacing', 'blockGap' ] );
		$global_layout_settings = wp_get_global_settings( [ 'layout' ] );
		$has_block_gap_support  = ! empty( $block_gap );
		$default_block_layout   = ! empty( $block_type->supports ) ? _wp_array_get( $block_type->supports, [ '__experimentalLayout', 'default' ], [] ) : [];

		$used_layout = isset( $block['attrs']['layout'] ) ? $block['attrs']['layout'] : $default_block_layout;

		if ( isset( $used_layout['inherit'] ) && $used_layout['inherit'] ) {
			if ( ! $global_layout_settings ) {
				return $block_content;
			}
		}

		$block_classname = wp_get_block_default_classname( $block['blockName'] );
		// First the first css class that starts with wp-container- and ends by a quote or space or &.
		$container_class = preg_match( '/wp-container-[^\s&"]+/', $block_content, $matches ) ? $matches[0] : wp_unique_id( 'wp-container-' );

		// Set the correct layout type for blocks using legacy content width.
		if ( isset( $used_layout['inherit'] ) && $used_layout['inherit'] || isset( $used_layout['contentSize'] ) && $used_layout['contentSize'] ) {
			$used_layout['type'] = 'constrained';
		}

		$gap_value = _wp_array_get( $block, [ 'attrs', 'style', 'spacing', 'blockGap' ] );

		/*
		 * Skip if gap value contains unsupported characters.
		 * Regex for CSS value borrowed from `safecss_filter_attr`, and used here
		 * to only match against the value, not the CSS attribute.
		 */
		if ( is_array( $gap_value ) ) {
			foreach ( $gap_value as $key => $value ) {
				$gap_value[ $key ] = $value && preg_match( '%[\\\(&=}]|/\*%', $value ) ? null : $value;
			}
		} else {
			$gap_value = $gap_value && preg_match( '%[\\\(&=}]|/\*%', $gap_value ) ? null : $gap_value;
		}

		$fallback_gap_value = ! empty( $block_type->supports ) ? _wp_array_get( $block_type->supports, [ 'spacing', 'blockGap', '__experimentalDefault' ], '0.5em' ) : '0.5em';
		$block_spacing      = _wp_array_get( $block, [ 'attrs', 'style', 'spacing' ], null );

		/*
		 * If a block's block.json skips serialization for spacing or spacing.blockGap,
		 * don't apply the user-defined value to the styles.
		 */
		$should_skip_gap_serialization = wp_should_skip_block_supports_serialization( $block_type, 'spacing', 'blockGap' );

		$style = wp_get_layout_style(
			".$block_classname.$container_class",
			$used_layout,
			$has_block_gap_support,
			$gap_value,
			$should_skip_gap_serialization,
			$fallback_gap_value,
			$block_spacing
		);

		$content = preg_replace(
			'/' . preg_quote( 'class="', '/' ) . '/',
			'class="' . esc_attr( $container_class ) . ' ',
			$block_content,
			1
		);

		// This is all that's really being modified here.
		return $content . ( $style ? '<style>' . $style . '</style>' : '' );
	}
}
