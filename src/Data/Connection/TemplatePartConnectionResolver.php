<?php
/**
 * The Template Part Area GraphQL DataLoader.
 *
 * @package WPGraphQL\SiteEditor\Data\Resolver
 */

namespace WPGraphQL\SiteEditor\Data\Connection;

use WPGraphQL\Data\Connection\AbstractConnectionResolver;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartLoader;

/**
 * Class TemplatePartConnectionResolver
 */
class TemplatePartConnectionResolver extends AbstractConnectionResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @var ?array
	 */
	protected $query;

	/**
	 * The WP_Block_Template type to use for the query.
	 *
	 * @var string
	 */
	protected string $template_type;

	/**
	 * {@inheritDoc}
	 * 
	 * @param \WPGraphQL\AppContext $context .
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @param string $template_type The template type. Either 'wp_template' or 'wp_template_part'.
	 */
	public function __construct( $source, array $args, $context, $info, $template_type = 'wp_template_part' ) {
		$this->template_type = $template_type;

		/**
		 * Call the parent construct to setup class data
		 */
		parent::__construct( $source, $args, $context, $info );
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_ids_from_query() {
		if ( isset( $this->args['where']['include'] ) ) {
			return $this->args['where']['include'];
		}

		if ( isset( $this->args['where']['exclude'] ) ) {
			return $this->args['where']['exclude'];
		}

		$ids     = [];
		$queried = $this->get_query();

		if ( empty( $queried ) ) {
			return $ids;
		}


		foreach ( $queried as $key => $item ) {
			$ids[ $key ] = $item->slug;
		}

		return $ids;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_query_args() {
		$query_args = [];

		if ( ! empty( $this->args['where']['slugIn'] ) ) {
			$query_args['slug__in'] = $this->args['where']['slugIn'];
		}

		if ( ! empty( $this->args['where']['area'] ) ) {
			$query_args['area'] = $this->args['where']['area'];
		}

		if ( ! empty( $this->args['where']['contentType'] ) ) {
			$query_args['post_type'] = $this->args['where']['contentType'];
		}

		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return \WP_Block_Template[]
	 */
	public function get_query() {
		return get_block_templates( $this->query_args, $this->template_type );
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_loader_name() {
		return TemplatePartLoader::LOADER_NAME;
	}

	/**
	 * {@inheritDoc}
	 */
	public function is_valid_offset( $offset ) {
		return in_array( $offset, $this->get_query(), true );
	}

	/**
	 * {@inheritDoc}
	 */
	public function should_execute() {
		return true;
	}
}
