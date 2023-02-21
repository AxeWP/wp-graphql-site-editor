<?php
/**
 * The Template Part Area GraphQL DataLoader.
 *
 * @package WPGraphQL\SiteEditor\Data\Resolver
 */

namespace WPGraphQL\SiteEditor\Data\Connection;

use WPGraphQL\Data\Connection\AbstractConnectionResolver;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartAreaLoader;

/**
 * Class TemplatePartAreaConnectionResolver
 */
class TemplatePartAreaConnectionResolver extends AbstractConnectionResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @var ?array
	 */
	protected $query;

	/**
	 * {@inheritDoc}
	 */
	public function get_ids_from_query() {

		// Given a list of role slugs
		if ( isset( $this->args['where']['include'] ) ) {
			return $this->args['where']['include'];
		}

		// Given a list of role slugs
		if ( isset( $this->args['where']['exclude'] ) ) {
			return $this->args['where']['exclude'];
		}

		$ids     = [];
		$queried = $this->get_query();

		if ( empty( $queried ) ) {
			return $ids;
		}

		foreach ( $queried as $key => $item ) {
			$ids[ $key ] = $item;
		}

		return $ids;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_query_args() {
		// If any args are added to filter/sort the connection
		return [];
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_query() {
		if ( ! isset( $this->query ) ) {
			$template_part_areas = get_allowed_block_template_part_areas();

			// Get the 'area' column from the $template_part_areas array.
			$query = ! empty( $template_part_areas ) ? array_column( $template_part_areas, 'area' ) : [];

			// if $this->args['include'] is set, only return the roles that are in the array,
			if ( ! empty( $this->args['where']['include'] ) ) {
				$query = array_intersect( $query, $this->args['where']['include'] );
			}

			// if $this->args['exclude'] is set, remove any roles that are in the array.
			if ( ! empty( $this->args['where']['exclude'] ) ) {
				$query = array_diff( $query, $this->args['where']['exclude'] );
			}

			$this->query = $query;
		}

		return $this->query;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_loader_name() {
		return TemplatePartAreaLoader::LOADER_NAME;
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
